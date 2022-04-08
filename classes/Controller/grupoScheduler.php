<?php

namespace controller;

use Carbon\Carbon;
use GrupoScheduleQuery;

class GrupoScheduler
{
    public static function cadastrarGrupoSchedule($post, $userid)
    {
        # verificar se o grupo existe no banco, se não cria
        $grupo = \GrupoQuery::create()->filterByZabbixid($post['groupid'])->findOneOrCreate();
        if ($grupo->isNew()) {
            $grupo->setNome($post['groupname']);
            $grupo->setZabbixid($post['groupid']);
            $grupo->save();
        }

        # convert datetime to timestamp
        $now = Carbon::create()->now('America/Sao_Paulo')->getTimestamp();
        $start = Carbon::parse($post['start'], 'America/Sao_Paulo')->getTimestamp();
        $end = Carbon::parse($post['end'], 'America/Sao_Paulo')->getTimestamp();

        # create schedule
        $schedule = new \Schedule();
        $schedule->setOriginalValue('grupo_manutenção');
        $schedule->setNewValue('grupo_manutenção');
        $schedule->setDateFrom($start);
        $schedule->setDateUntil($end);
        $schedule->setExecuted(false);
        $schedule->setReverted(false);
        $schedule->save();

        # create group_schedule
        $groupSchedule = new \GrupoSchedule();
        $groupSchedule->setDescription($post['description']);
        $groupSchedule->setScheduleId($schedule->getId());
        $groupSchedule->setGrupoId($grupo->getId());
        $groupSchedule->setUsuarioId($userid);
        $groupSchedule->setScheduled($now);
        $groupSchedule->setPushPop(b'1');
        $groupSchedule->setEnabled(b'1');

        $groupSchedule->save();

        return true;
    }
    public static function editarGrupoScheduleNotExecuted($post, $userid)
    {
        $grupoSchedule = \GrupoScheduleQuery::create()->findOneById($post['schid']);
        if ($grupoSchedule != NULL) {
            # cria o log, salva hora e id do usuário realizando a alteração.
            $log = new \Log();
            $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
            $log->setUsuarioId($userid);
            $log->save();

            # salva dados antes e depois da alteração
            $Editelog = new \LogEditeGrupoSchedule();
            $Editelog->setGrupoScheduleId($grupoSchedule->getId());
            $Editelog->setLogId($log->getId());

            $Editelog->setOldGrupoId($grupoSchedule->getGrupoId());
            $Editelog->setNewGrupoId($grupoSchedule->getGrupoId());

            $Editelog->setOldDateFrom($grupoSchedule->getSchedule()->getDateFrom());
            $Editelog->setNewDateFrom(Carbon::parse($post['start'], 'America/Sao_Paulo')->getTimestamp());

            $Editelog->setOldDateUntil($grupoSchedule->getSchedule()->getDateUntil());
            $Editelog->setNewDateUntil(Carbon::parse($post['end'], 'America/Sao_Paulo')->getTimestamp());

            $Editelog->setOldPushPop($grupoSchedule->getPushPop());
            $Editelog->setNewPushPop($grupoSchedule->getPushPop());

            $Editelog->save();

            # atualiza os dados 
            $grupoSchedule->getSchedule()->setDateFrom(Carbon::parse($_POST['start'], 'America/Sao_Paulo')->getTimestamp());
            $grupoSchedule->getSchedule()->setDateUntil(Carbon::parse($_POST['end'], 'America/Sao_Paulo')->getTimestamp());
            $grupoSchedule->setDescription($_POST['descr']);
            $grupoSchedule->getSchedule()->save();
            $grupoSchedule->save();

            return true;
        } else {
            return false;
        }
    }
    public static function editarGrupoScheduleExecuted($post, $userid)
    {
        $grupoSchedule = \GrupoScheduleQuery::create()->findOneById($post['schid']);
        if ($grupoSchedule != NULL) {
            # cria o log, salva hora e id do usuário realizando a alteração.
            $log = new \Log();
            $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
            $log->setUsuarioId($userid);
            $log->save();

            # salva dados antes e depois da alteração
            $Editelog = new \LogEditeGrupoSchedule();
            $Editelog->setGrupoScheduleId($grupoSchedule->getId());
            $Editelog->setLogId($log->getId());

            $Editelog->setOldGrupoId($grupoSchedule->getGrupoId());
            $Editelog->setNewGrupoId($grupoSchedule->getGrupoId());

            $Editelog->setOldDateFrom($grupoSchedule->getSchedule()->getDateFrom());
            $Editelog->setNewDateFrom($grupoSchedule->getSchedule()->getDateFrom());

            $Editelog->setOldDateUntil($grupoSchedule->getSchedule()->getDateUntil());
            $Editelog->setNewDateUntil(Carbon::parse($post['end'], 'America/Sao_Paulo')->getTimestamp());

            $Editelog->setOldPushPop($grupoSchedule->getPushPop());
            $Editelog->setNewPushPop($grupoSchedule->getPushPop());

            $Editelog->save();

            # atualiza os dados 
            $grupoSchedule->getSchedule()->setDateUntil(Carbon::parse($_POST['end'], 'America/Sao_Paulo')->getTimestamp());
            $grupoSchedule->getSchedule()->save();
            $grupoSchedule->save();

            return true;
        } else {
            return false;
        }
    }
    public static function deletarGrupoSchedule($grupoSchedule, $userid)
    {
        # cria o log, salva hora e id do usuário realizando a alteração.
        $log = new \Log();
        $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
        $log->setUsuarioId($userid);
        $log->save();

        # log delete
        $deleteLog = new \LogDeleteGrupoSchedule();
        $deleteLog->setGrupoScheduleId($grupoSchedule->getId());
        $deleteLog->setLogId($log->getId());
        $deleteLog->save();

        # disable schedule 
        $grupoSchedule->setEnabled(b'0');
        $grupoSchedule->save();

        return true;
    }
}