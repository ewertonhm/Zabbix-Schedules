<?php

namespace controller;
use Carbon\Carbon;
use \MacroScheduleQuery;

class Macro
{
    static public function getUserCreatedMacros($userid)
    {
        # Coleta os macros que estão com status enabled e que foram criados pelo usuário que está logado
        $userSchedules = MacroScheduleQuery::create()->filterByEnabled(b'1')->findByUsuarioId($userid);
        $counter = 0;

        foreach($userSchedules as $m){
            $vars['schedule'][$counter]['id'] = $m->getId();
            $vars['schedule'][$counter]['scheduled'] = Carbon::createFromTimestamp($m->getScheduled(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['usuario'] = $m->getUsuario()->getLogin();
            $vars['schedule'][$counter]['host'] = $m->getHost()->getNome();
            $vars['schedule'][$counter]['macro'] = $m->getMacro()->getNome();
            $vars['schedule'][$counter]['schedule']['original'] = $m->getSchedule()->getOriginalValue();
            $vars['schedule'][$counter]['schedule']['new'] = $m->getSchedule()->getNewValue();
            $vars['schedule'][$counter]['schedule']['from'] = Carbon::createFromTimestamp($m->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['schedule']['until'] = Carbon::createFromTimestamp($m->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['schedule']['executed'] = $m->getSchedule()->getExecuted();
            $vars['schedule'][$counter]['schedule']['reverted'] = $m->getSchedule()->getReverted();
            $counter++;
        }
        if(isset($vars['schedule'])){
            return $vars['schedule'];
        }
    }
    static public function scheduleMacroSchedule($post, $userid)
    {
        # verificar se o host existe no banco, se não cria
        $host = \HostQuery::create()->filterByZabbixid($post['hostid'])->findOneOrCreate();
        if($host->isNew()){
            $host->setNome($post['hostname']);
            $host->setZabbixid($post['hostid']);
            $host->save();
        }

        # verifica se o macro existe no banco, se não cria
        $macro = \MacroQuery::create()->filterByZabbixid($post['macroid'])->findOneOrCreate();
        if($macro->isNew()){
            $macro->setNome($post['macroname']);
            $macro->setZabbixid($post['macroid']);
            $macro->save();
        }

        # convert datetime to timestamp
        $now = Carbon::create()->now('America/Sao_Paulo')->getTimestamp();
        $start = Carbon::parse($post['start'], 'America/Sao_Paulo')->getTimestamp();
        $end = null;
        if($post['end'] != ''){
            $end = Carbon::parse($post['end'], 'America/Sao_Paulo')->getTimestamp();
        }

        # create schedule
        $schedule = new \Schedule();
        $schedule->setOriginalValue($post['oldvalue']);
        $schedule->setNewValue($post['newvalue']);
        $schedule->setDateFrom($start);
        $schedule->setDateUntil($end);
        $schedule->setExecuted(false);
        $schedule->setReverted(false);
        $schedule->save();

        # create macro_schedule
        $macroSchedule = new \MacroSchedule();
        $macroSchedule->setScheduleId($schedule->getId());
        $macroSchedule->setHostId($host->getId());
        $macroSchedule->setUsuarioId($userid);
        $macroSchedule->setMacroId($macro->getId());
        $macroSchedule->setScheduled($now);
        $macroSchedule->setEnabled(b'1');
        $macroSchedule->save();

        return true;
    }
    static public function editeMacroScheduleNotExecuted($post, $userid){
        $macroSchedule = MacroScheduleQuery::create()->filterByUsuarioId($userid)->findOneById($post['schid']);
        if($macroSchedule != NULL){
            # cria o log, salva hora e id do usuário realizando a alteração.
            $log = new \Log();
            $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
            $log->setUsuarioId($_SESSION['id']);
            $log->save();

            # salva dados antes e depois da alteração
            $Editelog = new \LogEditeMacroSchedule();
            $Editelog->setMacroScheduleId($macroSchedule->getId());
            $Editelog->setLogId($log->getId());

            $Editelog->setOldDateFrom($macroSchedule->getSchedule()->getDateFrom());
            $Editelog->setNewDateFrom(Carbon::parse($_POST['start'], 'America/Sao_Paulo')->getTimestamp());
            
            $Editelog->setOldDateUntil($macroSchedule->getSchedule()->getDateUntil());
            $Editelog->setNewDateUntil(Carbon::parse($_POST['end'], 'America/Sao_Paulo')->getTimestamp());

            $Editelog->setOldOriginalValue($macroSchedule->getSchedule()->getOriginalValue());
            $Editelog->setNewOriginalValue($macroSchedule->getSchedule()->getOriginalValue());

            $Editelog->setOldNewValue($macroSchedule->getSchedule()->getNewValue());
            $Editelog->setNewNewValue($_POST['newvalue']);

            $Editelog->save();

            # atualiza os dados 
            $macroSchedule->getSchedule()->setDateFrom(Carbon::parse($_POST['start'], 'America/Sao_Paulo')->getTimestamp());
            $macroSchedule->getSchedule()->setDateUntil(Carbon::parse($_POST['end'], 'America/Sao_Paulo')->getTimestamp());
            $macroSchedule->getSchedule()->setNewValue($_POST['newvalue']);
            $macroSchedule->getSchedule()->save();
            $macroSchedule->save();
            return true;
        } else {
            return false;
        }
    }
    static public function editeMacroScheduleExecuted($post, $userid){
        $macroSchedule = MacroScheduleQuery::create()->filterByUsuarioId($userid)->findOneById($post['schid']);
        if($macroSchedule != NULL){
            # cria o log, salva hora e id do usuário realizando a alteração.
            $log = new \Log();
            $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
            $log->setUsuarioId($_SESSION['id']);
            $log->save();

            # salva dados antes e depois da alteração
            $Editelog = new \LogEditeMacroSchedule();
            $Editelog->setMacroScheduleId($macroSchedule->getId());
            $Editelog->setLogId($log->getId());

            $Editelog->setOldDateFrom($macroSchedule->getSchedule()->getDateFrom());
            $Editelog->setNewDateFrom($macroSchedule->getSchedule()->getDateFrom());
            
            $Editelog->setOldDateUntil($macroSchedule->getSchedule()->getDateUntil());
            $Editelog->setNewDateUntil(Carbon::parse($_POST['end'], 'America/Sao_Paulo')->getTimestamp());

            $Editelog->setOldOriginalValue($macroSchedule->getSchedule()->getOriginalValue());
            $Editelog->setNewOriginalValue($macroSchedule->getSchedule()->getOriginalValue());

            $Editelog->setOldNewValue($macroSchedule->getSchedule()->getNewValue());
            $Editelog->setNewNewValue($macroSchedule->getSchedule()->getNewValue());

            $Editelog->save();

            # atualiza os dados 
            $macroSchedule->getSchedule()->setDateUntil(Carbon::parse($_POST['end'], 'America/Sao_Paulo')->getTimestamp());
            $macroSchedule->getSchedule()->save();
            $macroSchedule->save();
            return true;
        } else {
            return false;
        }
    }
}