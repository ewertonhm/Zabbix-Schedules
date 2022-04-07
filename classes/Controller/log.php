<?php

namespace controller;
use Carbon\Carbon;
use \MacroScheduleQuery;
use \LogMacroExecutionQuery;
use \LogDeleteMacroScheduleQuery;
use \LogEditeMacroScheduleQuery;
use \LogGrupoExecutionQuery;
use \GrupoScheduleQuery;
use \HostScheduleQuery;
use LogDeleteGrupoScheduleQuery;
use LogDeleteHostScheduleQuery;
use LogEditeGrupoScheduleQuery;
use LogEditHostScheduleQuery;
use LogHostExecutionQuery;

class Log
{
    static public function createMacroExecutionLog($macroScheduleId,$pushpop)
    {
        $log = new \LogMacroExecution();
        $log->setMacroScheduleId($macroScheduleId);
        $log->setPushPop($pushpop);
        $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());

        return $log;
    }
    static public function createGrupoExecutionLog($grupoScheduleId, $pushpop)
    {
        $log = new \LogGrupoExecution();
        $log->setGrupoScheduleId($grupoScheduleId);
        $log->setPushPop($pushpop);
        $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());

        return $log;
    }
    static public function createHostsExecutionLog($hostScheduleId, $pushpop)
    {
        $log = new \LogHostExecution();
        $log->setHostScheduleId($hostScheduleId);
        $log->setPushPop($pushpop);
        $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());

        return $log;
    }
    static public function getMacroAddLog()
    {
        $logs = MacroScheduleQuery::create()->orderById('desc')->find();
        $counter = 0;
        foreach($logs as $log){
            $vars['macro']['add'][$counter]['date_from'] = Carbon::createFromTimestamp($log->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['add'][$counter]['date_until'] = Carbon::createFromTimestamp($log->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['add'][$counter]['original_value'] = $log->getSchedule()->getOriginalValue();
            $vars['macro']['add'][$counter]['new_value'] = $log->getSchedule()->getNewValue();
            $vars['macro']['add'][$counter]['host']['nome'] = $log->getHost()->getNome();
            $vars['macro']['add'][$counter]['host']['hostid'] = $log->getHost()->getZabbixid();
            $vars['macro']['add'][$counter]['macro']['nome'] = $log->getMacro()->getNome();
            $vars['macro']['add'][$counter]['macro']['id'] = $log->getMacro()->getZabbixid();
            $vars['macro']['add'][$counter]['usuario']['nome'] = $log->getUsuario()->getNome();
            $vars['macro']['add'][$counter]['usuario']['login'] = $log->getUsuario()->getLogin();
            $vars['macro']['add'][$counter]['logtime'] = Carbon::createFromTimestamp($log->getScheduled(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        if(isset($vars['macro'])){
            return $vars['macro'];
        }
    }
    static public function getMacroEditLog()
    {
        $logs = LogEditeMacroScheduleQuery::create()->find();
        $counter = 0;
        foreach($logs as $log){
            $vars['macro']['edit'][$counter]['old_date_from'] = Carbon::createFromTimestamp($log->getOldDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['edit'][$counter]['new_date_from'] = Carbon::createFromTimestamp($log->getNewDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['edit'][$counter]['old_date_until'] = Carbon::createFromTimestamp($log->getOldDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['edit'][$counter]['new_date_until'] = Carbon::createFromTimestamp($log->getNewDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['edit'][$counter]['original_value'] = $log->getOldOriginalValue();
            $vars['macro']['edit'][$counter]['old_new_value'] = $log->getOldNewValue();
            $vars['macro']['edit'][$counter]['new_new_value'] = $log->getNewNewValue();
            $vars['macro']['edit'][$counter]['host']['nome'] = $log->getMacroSchedule()->getHost()->getNome();
            $vars['macro']['edit'][$counter]['host']['hostid'] = $log->getMacroSchedule()->getHost()->getZabbixid();
            $vars['macro']['edit'][$counter]['macro']['nome'] = $log->getMacroSchedule()->getMacro()->getNome();
            $vars['macro']['edit'][$counter]['macro']['id'] = $log->getMacroSchedule()->getMacro()->getZabbixid();
            $vars['macro']['edit'][$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $vars['macro']['edit'][$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $vars['macro']['edit'][$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        if(isset($vars['macro'])){
            return $vars['macro'];
        }

    }
    static public function getMacroDelLog()
    {
        $logs = LogDeleteMacroScheduleQuery::create()->orderById('desc')->find();
        $counter = 0;
        foreach($logs as $log){
            $vars['macro']['del'][$counter]['date_from'] = Carbon::createFromTimestamp($log->getMacroSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['del'][$counter]['date_until'] = Carbon::createFromTimestamp($log->getMacroSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['del'][$counter]['original_value'] = $log->getMacroSchedule()->getSchedule()->getOriginalValue();
            $vars['macro']['del'][$counter]['new_value'] = $log->getMacroSchedule()->getSchedule()->getNewValue();
            $vars['macro']['del'][$counter]['host']['nome'] = $log->getMacroSchedule()->getHost()->getNome();
            $vars['macro']['del'][$counter]['host']['hostid'] = $log->getMacroSchedule()->getHost()->getZabbixid();
            $vars['macro']['del'][$counter]['macro']['nome'] = $log->getMacroSchedule()->getMacro()->getNome();
            $vars['macro']['del'][$counter]['macro']['id'] = $log->getMacroSchedule()->getMacro()->getZabbixid();
            $vars['macro']['del'][$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $vars['macro']['del'][$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $vars['macro']['del'][$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        if(isset($vars['macro'])){
            return $vars['macro'];
        }
    }
    static public function getMacroExecutionLog()
    {
        $logs = LogMacroExecutionQuery::create()->orderById('desc')->find();
        $counter = 0;
        foreach($logs as $log){
            $vars['macro']['exec'][$counter]['pushpop'] = $log->getPushPop();
            $vars['macro']['exec'][$counter]['date_from'] = Carbon::createFromTimestamp($log->getMacroSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['exec'][$counter]['date_until'] = Carbon::createFromTimestamp($log->getMacroSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $vars['macro']['exec'][$counter]['original_value'] = $log->getMacroSchedule()->getSchedule()->getOriginalValue();
            $vars['macro']['exec'][$counter]['new_value'] = $log->getMacroSchedule()->getSchedule()->getNewValue();
            $vars['macro']['exec'][$counter]['host']['nome'] = $log->getMacroSchedule()->getHost()->getNome();
            $vars['macro']['exec'][$counter]['host']['hostid'] = $log->getMacroSchedule()->getHost()->getZabbixid();
            $vars['macro']['exec'][$counter]['macro']['nome'] = $log->getMacroSchedule()->getMacro()->getNome();
            $vars['macro']['exec'][$counter]['macro']['id'] = $log->getMacroSchedule()->getMacro()->getZabbixid();
            $vars['macro']['exec'][$counter]['usuario']['nome'] = 'crontab';
            $vars['macro']['exec'][$counter]['usuario']['login'] = 'server';
            $vars['macro']['exec'][$counter]['logtime'] = Carbon::createFromTimestamp($log->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        if(isset($vars['macro'])){
            return $vars['macro'];
        }
    }
    static public function getMacroLog()
    {
        $logsarray = [];

            $logs = MacroScheduleQuery::create()->find();
            $counter = 0;
            foreach($logs as $log){
                $logsarray[$counter]['action'] = 'CREATE';
                $logsarray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['original_value'] = $log->getSchedule()->getOriginalValue();
                $logsarray[$counter]['new_value'] = $log->getSchedule()->getNewValue();
                $logsarray[$counter]['host']['nome'] = $log->getHost()->getNome();
                $logsarray[$counter]['host']['hostid'] = $log->getHost()->getZabbixid();
                $logsarray[$counter]['macro']['nome'] = $log->getMacro()->getNome();
                $logsarray[$counter]['macro']['id'] = $log->getMacro()->getZabbixid();
                $logsarray[$counter]['usuario']['nome'] = $log->getUsuario()->getNome();
                $logsarray[$counter]['usuario']['login'] = $log->getUsuario()->getLogin();
                $logsarray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getScheduled(),'America/Sao_Paulo)')->toDateTimeString();
                $counter++;
            }

            $logs = LogEditeMacroScheduleQuery::create()->find();
            foreach($logs as $log){
                $logsarray[$counter]['action'] = 'EDIT';
                $logsarray[$counter]['old_date_from'] = Carbon::createFromTimestamp($log->getOldDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['new_date_from'] = Carbon::createFromTimestamp($log->getNewDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['old_date_until'] = Carbon::createFromTimestamp($log->getOldDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['new_date_until'] = Carbon::createFromTimestamp($log->getNewDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['original_value'] = $log->getOldOriginalValue();
                $logsarray[$counter]['old_new_value'] = $log->getOldNewValue();
                $logsarray[$counter]['new_new_value'] = $log->getNewNewValue();
                $logsarray[$counter]['host']['nome'] = $log->getMacroSchedule()->getHost()->getNome();
                $logsarray[$counter]['host']['hostid'] = $log->getMacroSchedule()->getHost()->getZabbixid();
                $logsarray[$counter]['macro']['nome'] = $log->getMacroSchedule()->getMacro()->getNome();
                $logsarray[$counter]['macro']['id'] = $log->getMacroSchedule()->getMacro()->getZabbixid();
                $logsarray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
                $logsarray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
                $logsarray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
                $counter++;
            }
            $logs = LogDeleteMacroScheduleQuery::create()->find();
            foreach($logs as $log){
                $logsarray[$counter]['action'] = 'DELETE';
                $logsarray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getMacroSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getMacroSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['original_value'] = $log->getMacroSchedule()->getSchedule()->getOriginalValue();
                $logsarray[$counter]['new_value'] = $log->getMacroSchedule()->getSchedule()->getNewValue();
                $logsarray[$counter]['host']['nome'] = $log->getMacroSchedule()->getHost()->getNome();
                $logsarray[$counter]['host']['hostid'] = $log->getMacroSchedule()->getHost()->getZabbixid();
                $logsarray[$counter]['macro']['nome'] = $log->getMacroSchedule()->getMacro()->getNome();
                $logsarray[$counter]['macro']['id'] = $log->getMacroSchedule()->getMacro()->getZabbixid();
                $logsarray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
                $logsarray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
                $logsarray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
                $counter++;
            }
            $logs = LogMacroExecutionQuery::create()->find();
            foreach($logs as $log){
                $logsarray[$counter]['action'] = $log->getPushPop();
                $logsarray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getMacroSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getMacroSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
                $logsarray[$counter]['original_value'] = $log->getMacroSchedule()->getSchedule()->getOriginalValue();
                $logsarray[$counter]['new_value'] = $log->getMacroSchedule()->getSchedule()->getNewValue();
                $logsarray[$counter]['host']['nome'] = $log->getMacroSchedule()->getHost()->getNome();
                $logsarray[$counter]['host']['hostid'] = $log->getMacroSchedule()->getHost()->getZabbixid();
                $logsarray[$counter]['macro']['nome'] = $log->getMacroSchedule()->getMacro()->getNome();
                $logsarray[$counter]['macro']['id'] = $log->getMacroSchedule()->getMacro()->getZabbixid();
                $logsarray[$counter]['usuario']['nome'] = 'crontab';
                $logsarray[$counter]['usuario']['login'] = 'server';
                $logsarray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
                $counter++;
            } 

            $vars['macro']['all'] = DateTimeSorter::SortArray($logsarray);
            if(isset($vars['macro'])){
                return $vars['macro'];
            }
    }
    static public function getGrupoAddLog()
    {
        $logs = GrupoScheduleQuery::create()->orderById('desc')->find();
        $counter = 0;
        foreach($logs as $log){
            $logsarray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsarray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsarray[$counter]['original_value'] = $log->getSchedule()->getOriginalValue();
            $logsarray[$counter]['grupo']['nome'] = $log->getGrupo()->getNome();
            $logsarray[$counter]['grupo']['hostid'] = $log->getGrupo()->getZabbixid();
            $logsarray[$counter]['usuario']['nome'] = $log->getUsuario()->getNome();
            $logsarray[$counter]['usuario']['login'] = $log->getUsuario()->getLogin();
            $logsarray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getScheduled(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        $logs = HostScheduleQuery::create()->orderById('desc')->find();
        foreach($logs as $log){
            $logsarray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsarray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsarray[$counter]['original_value'] = $log->getSchedule()->getOriginalValue();
            $logsarray[$counter]['host']['nome'] = $log->getHost()->getNome();
            $logsarray[$counter]['host']['hostid'] = $log->getHost()->getZabbixid();
            $logsarray[$counter]['usuario']['nome'] = $log->getUsuario()->getNome();
            $logsarray[$counter]['usuario']['login'] = $log->getUsuario()->getLogin();
            $logsarray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getScheduled(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        $vars['grupo']['add'] = DateTimeSorter::SortArray($logsarray);
        if(isset($vars['grupo'])){
            return $vars['grupo'];
        }
    }
    static public function getGrupoEditLog()
    {
        $logs = LogEditeGrupoScheduleQuery::create()->find();
        $counter = 0;
        foreach($logs as $log){
            $logsArray[$counter]['old_date_from'] = Carbon::createFromTimestamp($log->getOldDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['new_date_from'] = Carbon::createFromTimestamp($log->getNewDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['old_date_until'] = Carbon::createFromTimestamp($log->getOldDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['new_date_until'] = Carbon::createFromTimestamp($log->getNewDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['grupo']['nome'] = $log->getGrupoSchedule()->getGrupo()->getNome();
            $logsArray[$counter]['grupo']['groupid'] = $log->getGrupoSchedule()->getGrupo()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }

        $logs = LogEditHostScheduleQuery::create()->find();

        foreach($logs as $log){
            $logsArray[$counter]['old_date_from'] = Carbon::createFromTimestamp($log->getOldDataFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['new_date_from'] = Carbon::createFromTimestamp($log->getNewDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['old_date_until'] = Carbon::createFromTimestamp($log->getOldDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['new_date_until'] = Carbon::createFromTimestamp($log->getNewDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['host']['nome'] = $log->getHostSchedule()->getHost()->getNome();
            $logsArray[$counter]['host']['hostid'] = $log->getHostSchedule()->getHost()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        $vars['grupo']['edit'] = DateTimeSorter::SortArray($logsArray);

        if(isset($vars['grupo'])){
            return $vars['grupo'];
        }

    }
    static public function getGrupoDelLog()
    {
        $logs = LogDeleteGrupoScheduleQuery::create()->find();
        $counter = 0;
        foreach($logs as $log){
            $logsArray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getGrupoSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getGrupoSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['original_value'] = $log->getGrupoSchedule()->getSchedule()->getOriginalValue();
            $logsArray[$counter]['grupo']['nome'] = $log->getGrupoSchedule()->getGrupo()->getNome();
            $logsArray[$counter]['grupo']['groupid'] = $log->getGrupoSchedule()->getGrupo()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }

        $logs = LogDeleteHostScheduleQuery::create()->find();
        foreach($logs as $log){
            $logsArray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getHostSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getHostSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['original_value'] = $log->getHostSchedule()->getSchedule()->getOriginalValue();
            $logsArray[$counter]['host']['nome'] = $log->getHostSchedule()->getHost()->getNome();
            $logsArray[$counter]['host']['hostid'] = $log->getHostSchedule()->getHost()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        $vars['grupo']['del'] = DateTimeSorter::SortArray($logsArray);

        if(isset($vars['grupo'])){
            return $vars['grupo'];
        }
    }
    static public function getGrupoExecutionLog()
    {
        $logs = LogGrupoExecutionQuery::create()->find();
        $counter = 0;
        foreach($logs as $log){
            $logsarray[$counter]['pushpop'] = $log->getPushPop();
            $logsarray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getGrupoSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsarray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getGrupoSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsarray[$counter]['original_value'] = $log->getGrupoSchedule()->getSchedule()->getOriginalValue();
            $logsarray[$counter]['new_value'] = $log->getGrupoSchedule()->getSchedule()->getNewValue();
            $logsarray[$counter]['grupo']['nome'] = $log->getGrupoSchedule()->getGrupo()->getNome();
            $logsarray[$counter]['grupo']['hostid'] = $log->getGrupoSchedule()->getGrupo()->getZabbixid();
            $logsarray[$counter]['macro']['nome'] = $log->getGrupoSchedule()->getGrupo()->getNome();
            $logsarray[$counter]['macro']['id'] = $log->getGrupoSchedule()->getGrupo()->getZabbixid();
            $logsarray[$counter]['usuario']['nome'] = 'crontab';
            $logsarray[$counter]['usuario']['login'] = 'server';
            $logsarray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }

        $logs = LogHostExecutionQuery::create()->find();
        foreach($logs as $log){
            $logsarray[$counter]['pushpop'] = $log->getPushPop();
            $logsarray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getHostSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsarray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getHostSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsarray[$counter]['original_value'] = $log->getHostSchedule()->getSchedule()->getOriginalValue();
            $logsarray[$counter]['new_value'] = $log->getHostSchedule()->getSchedule()->getNewValue();
            $logsarray[$counter]['host']['nome'] = $log->getHostSchedule()->getHost()->getNome();
            $logsarray[$counter]['host']['hostid'] = $log->getHostSchedule()->getHost()->getZabbixid();
            $logsarray[$counter]['macro']['nome'] = $log->getHostSchedule()->getHost()->getNome();
            $logsarray[$counter]['macro']['id'] = $log->getHostSchedule()->getHost()->getZabbixid();
            $logsarray[$counter]['usuario']['nome'] = 'crontab';
            $logsarray[$counter]['usuario']['login'] = 'server';
            $logsarray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }

        $vars['grupo']['exec'] = DateTimeSorter::SortArray($logsarray);
        if(isset($vars['grupo'])){
            return $vars['grupo'];
        }
    }
    static public function getGrupoLog()
    {
        $logs = GrupoScheduleQuery::create()->orderById('desc')->find();
        $counter = 0;
        foreach($logs as $log){
            $logsArray[$counter]['action'] = 'CREATE';
            $logsArray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['original_value'] = $log->getSchedule()->getOriginalValue();
            $logsArray[$counter]['grupo']['nome'] = $log->getGrupo()->getNome();
            $logsArray[$counter]['grupo']['groupid'] = $log->getGrupo()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getScheduled(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        $logs = HostScheduleQuery::create()->orderById('desc')->find();
        foreach($logs as $log){
            $logsArray[$counter]['action'] = 'CREATE';
            $logsArray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['original_value'] = $log->getSchedule()->getOriginalValue();
            $logsArray[$counter]['host']['nome'] = $log->getHost()->getNome();
            $logsArray[$counter]['host']['hostid'] = $log->getHost()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getScheduled(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        $logs = LogDeleteGrupoScheduleQuery::create()->find();
        foreach($logs as $log){
            $logsArray[$counter]['action'] = 'DELETE';
            $logsArray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getGrupoSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getGrupoSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['original_value'] = $log->getGrupoSchedule()->getSchedule()->getOriginalValue();
            $logsArray[$counter]['grupo']['nome'] = $log->getGrupoSchedule()->getGrupo()->getNome();
            $logsArray[$counter]['grupo']['groupid'] = $log->getGrupoSchedule()->getGrupo()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }

        $logs = LogDeleteHostScheduleQuery::create()->find();
        foreach($logs as $log){
            $logsArray[$counter]['action'] = 'DELETE';
            $logsArray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getHostSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getHostSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['original_value'] = $log->getHostSchedule()->getSchedule()->getOriginalValue();
            $logsArray[$counter]['host']['nome'] = $log->getHostSchedule()->getHost()->getNome();
            $logsArray[$counter]['host']['hostid'] = $log->getHostSchedule()->getHost()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }

        $logs = LogEditeGrupoScheduleQuery::create()->find();
        foreach($logs as $log){
            $logsArray[$counter]['action'] = 'EDIT';
            $logsArray[$counter]['old_date_from'] = Carbon::createFromTimestamp($log->getOldDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['new_date_from'] = Carbon::createFromTimestamp($log->getNewDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['old_date_until'] = Carbon::createFromTimestamp($log->getOldDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['new_date_until'] = Carbon::createFromTimestamp($log->getNewDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['grupo']['nome'] = $log->getGrupoSchedule()->getGrupo()->getNome();
            $logsArray[$counter]['grupo']['groupid'] = $log->getGrupoSchedule()->getGrupo()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }

        $logs = LogEditHostScheduleQuery::create()->find();
        foreach($logs as $log){
            $logsArray[$counter]['action'] = 'EDIT';
            $logsArray[$counter]['old_date_from'] = Carbon::createFromTimestamp($log->getOldDataFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['new_date_from'] = Carbon::createFromTimestamp($log->getNewDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['old_date_until'] = Carbon::createFromTimestamp($log->getOldDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['new_date_until'] = Carbon::createFromTimestamp($log->getNewDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['host']['nome'] = $log->getHostSchedule()->getHost()->getNome();
            $logsArray[$counter]['host']['hostid'] = $log->getHostSchedule()->getHost()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = $log->getLog()->getUsuario()->getNome();
            $logsArray[$counter]['usuario']['login'] = $log->getLog()->getUsuario()->getLogin();
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLog()->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }
        $logs = LogGrupoExecutionQuery::create()->find();
        foreach($logs as $log){
            $logsArray[$counter]['action'] = 'EXEC';
            $logsArray[$counter]['pushpop'] = $log->getPushPop();
            $logsArray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getGrupoSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getGrupoSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['original_value'] = $log->getGrupoSchedule()->getSchedule()->getOriginalValue();
            $logsArray[$counter]['new_value'] = $log->getGrupoSchedule()->getSchedule()->getNewValue();
            $logsArray[$counter]['grupo']['nome'] = $log->getGrupoSchedule()->getGrupo()->getNome();
            $logsArray[$counter]['grupo']['hostid'] = $log->getGrupoSchedule()->getGrupo()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = 'crontab';
            $logsArray[$counter]['usuario']['login'] = 'server';
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }

        $logs = LogHostExecutionQuery::create()->find();
        foreach($logs as $log){
            $logsArray[$counter]['action'] = 'EXEC';
            $logsArray[$counter]['pushpop'] = $log->getPushPop();
            $logsArray[$counter]['date_from'] = Carbon::createFromTimestamp($log->getHostSchedule()->getSchedule()->getDateFrom(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['date_until'] = Carbon::createFromTimestamp($log->getHostSchedule()->getSchedule()->getDateUntil(),'America/Sao_Paulo)')->toDateTimeString();
            $logsArray[$counter]['original_value'] = $log->getHostSchedule()->getSchedule()->getOriginalValue();
            $logsArray[$counter]['new_value'] = $log->getHostSchedule()->getSchedule()->getNewValue();
            $logsArray[$counter]['host']['nome'] = $log->getHostSchedule()->getHost()->getNome();
            $logsArray[$counter]['host']['hostid'] = $log->getHostSchedule()->getHost()->getZabbixid();
            $logsArray[$counter]['usuario']['nome'] = 'crontab';
            $logsArray[$counter]['usuario']['login'] = 'server';
            $logsArray[$counter]['logtime'] = Carbon::createFromTimestamp($log->getLogtime(),'America/Sao_Paulo)')->toDateTimeString();
            $counter++;
        }


        $vars['grupo']['all'] = DateTimeSorter::SortArray($logsArray);
        if(isset($vars['grupo'])){
            return $vars['grupo'];
        }

    }


}