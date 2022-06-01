<?php

namespace controller;

use controller\ZabbixQuery;
use controller\Log;
use Carbon\Carbon;
use \MacroScheduleQuery;
use \LogMacroExecution;
use \GrupoScheduleQuery;
use \HostScheduleQuery;

class Scheduler
{
    private $grupoManutencaoId = ['1092'];
    private $now;

    protected $macroDo = [];
    protected $macroUndo = [];
    protected $grupoDo = [];
    protected $grupoUndo = [];
    protected $hostDo = [];
    protected $hostUndo = [];

    protected $macroList = false;
    protected $groupList = false;
    protected $hostList = false;

    public function __construct()
    {
        $this->now = Carbon::create()->now('America/Sao_Paulo')->getTimestamp();
    }

    protected function macrosToRun()
    {
        $macros = MacroScheduleQuery::create()->filterByEnabled(1)->find();
        foreach ($macros as $macro) {
            # verifica se não foi executado e se já passou da data para execução;
            if (!$macro->getSchedule()->getExecuted() and $macro->getSchedule()->getDateFrom() <= $this->now) {
                $this->macroDo[] = $macro;
            }
            # verifica se já foi executado, se não foi revertido e se já passou da data para reverter;
            elseif ($macro->getSchedule()->getExecuted() and !$macro->getSchedule()->getReverted() and $macro->getSchedule()->getDateUntil() <= $this->now) {
                $this->macroUndo[] = $macro;
            }
        }
        $this->macroList = true;
    }
    protected function macroDoRun()
    {
        foreach ($this->macroDo as $macro) {
            $log = Log::createMacroExecutionLog($macro->getId(), b'1');

            $macro->getSchedule()->setExecuted(true);

            $response = ZabbixQuery::updateMacro($macro->getMacro()->getZabbixId(), $macro->getSchedule()->getNewValue());

            $executed = false;

            if ($response != null) {
                $executed = true;
            }

            if ($executed) {
                $macro->getSchedule()->save();
                $macro->save();
                $log->save();
            }
        }
    }
    protected function macroUndoRun()
    {
        foreach ($this->macroUndo as $macro) {
            $log = Log::createMacroExecutionLog($macro->getId(), b'0');

            $macro->getSchedule()->setReverted(true);
            $response = ZabbixQuery::updateMacro($macro->getMacro()->getZabbixId(), $macro->getSchedule()->getOriginalValue());

            $executed = false;

            if ($response != null) {
                $executed = true;
            }

            if ($executed) {
                $macro->getSchedule()->save();
                $macro->save();
                $log->save();
            }
        }
    }
    private function macroRun()
    {
        if (!$this->macroList) {
            $this->macrosToRun();
        }
        $this->macroDoRun();
        $this->macroUndoRun();
    }
    protected function groupsToRun()
    {
        $groups = GrupoScheduleQuery::create()->filterByEnabled(1)->find();
        foreach ($groups as $grupo) {
            if ($grupo->getSchedule()->getOriginalValue() == 'grupo_manutenção') {
                # verifica se não foi executado e se já passou da data para execução;
                if (!$grupo->getSchedule()->getExecuted() and $grupo->getSchedule()->getDateFrom() <= $this->now) {
                    $this->grupoDo[] = $grupo;
                }
                # verifica se já foi executado, se não foi revertido e se já passou da data para reverter;
                elseif ($grupo->getSchedule()->getExecuted() and !$grupo->getSchedule()->getReverted() and $grupo->getSchedule()->getDateUntil() <= $this->now) {
                    $this->grupoUndo[] = $grupo;
                }
            }
        }
        $this->groupList = true;
    }
    protected function groupsDoRun()
    {
        foreach ($this->grupoDo as $task) {
            $log = Log::createGrupoExecutionLog($task->getId(), b'1');

            $task->getSchedule()->setExecuted(true);

            $grupo = ZabbixQuery::getHostGroupsWithHosts($task->getGrupo()->getZabbixId());
            foreach ($grupo as $g) {
                $hosts_raw = $g['hosts'];
                $hosts = [];

                foreach ($hosts_raw as $h) {
                    $hosts[] = $h['hostid'];
                }
                $executed = false;

                $response = ZabbixQuery::addHostsToGroups($hosts, $this->grupoManutencaoId);

                if ($response != null) {
                    $executed = true;
                }

                if ($executed) {
                    $task->getSchedule()->save();
                    $task->save();
                    $log->save();
                }
            }
        }
    }
    protected function groupsUndoRun()
    {
        foreach ($this->grupoUndo as $task) {
            $log = Log::createGrupoExecutionLog($task->getId(), b'0');

            $task->getSchedule()->setReverted(true);

            $grupo = ZabbixQuery::getHostGroupsWithHosts($task->getGrupo()->getZabbixId());
            foreach ($grupo as $g) {
                $hosts_raw = $g['hosts'];
                $hosts = [];

                foreach ($hosts_raw as $h) {
                    $hosts[] = $h['hostid'];
                }
                $executed = false;

                $response = ZabbixQuery::removeHostsFromGroups($hosts, $this->grupoManutencaoId);

                if ($response != null) {
                    $executed = true;
                }

                if ($executed) {
                    $task->getSchedule()->save();
                    $task->save();
                    $log->save();
                }
            }
        }
    }
    private function groupsRun()
    {
        if (!$this->groupList) {
            $this->groupsToRun();
        }
        $this->groupsDoRun();
        $this->groupsUndoRun();
    }
    protected function hostsToRun()
    {
        $hosts = HostScheduleQuery::create()->filterByEnabled(1)->find();
        foreach ($hosts as $host) {
            if ($host->getSchedule()->getOriginalValue() == 'host_manutenção') {
                # verifica se não foi executado e se já passou da data para execução;
                if (!$host->getSchedule()->getExecuted() and $host->getSchedule()->getDateFrom() <= $this->now) {
                    $this->hostDo[] = $host;
                }
                # verifica se já foi executado, se não foi revertido e se já passou da data para reverter;
                elseif ($host->getSchedule()->getExecuted() and !$host->getSchedule()->getReverted() and $host->getSchedule()->getDateUntil() <= $this->now) {
                    $this->hostUndo[] = $host;
                }
            }
        }
        $this->hostList = true;
    }
    protected function hostsDoRun()
    {
        foreach ($this->hostDo as $task) {
            $log = Log::createHostsExecutionLog($task->getId(), b'1');

            $task->getSchedule()->setExecuted(true);

            $executed = false;

            $response = ZabbixQuery::addHostsToGroups([$task->getHost()->getZabbixId()], $this->grupoManutencaoId);

            if ($response != null) {
                $executed = true;
            }

            if ($executed) {
                $task->getSchedule()->save();
                $task->save();
                $log->save();
            }
        }
    }
    protected function hostsUndoRun()
    {
        foreach ($this->hostUndo as $task) {
            $log = Log::createHostsExecutionLog($task->getId(), b'0');

            $task->getSchedule()->setReverted(true);

            $executed = false;

            $response = ZabbixQuery::removeHostsFromGroups([$task->getHost()->getZabbixId()], $this->grupoManutencaoId);

            if ($response != null) {
                $executed = true;
            }

            if ($executed) {
                $task->getSchedule()->save();
                $task->save();
                $log->save();
            }
        }
    }
    private function hostsRun()
    {
        if (!$this->hostList) {
            $this->hostsToRun();
        }
        $this->hostsDoRun();
        $this->hostsUndoRun();
    }
    public function run()
    {
        $this->macroRun();
        $this->groupsRun();
        $this->hostsRun();
    }
}
