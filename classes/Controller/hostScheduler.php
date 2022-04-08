<?php

namespace controller;

use Carbon\Carbon;


class HostScheduler
{
    public static function cadastrarHostSchedule($post, $userid)
    {
        # verificar se o Host existe no banco, se não cria
        $host = \HostQuery::create()->filterByZabbixid($post['hostid'])->findOneOrCreate();
        if ($host->isNew()) {
            $host->setNome($post['hostname']);
            $host->setZabbixid($post['hostid']);
            $host->save();
        }

        # convert datetime to timestamp
        $now = Carbon::create()->now('America/Sao_Paulo')->getTimestamp();
        $start = Carbon::parse($post['start'], 'America/Sao_Paulo')->getTimestamp();
        $end = Carbon::parse($post['end'], 'America/Sao_Paulo')->getTimestamp();

        # create schedule
        $schedule = new \Schedule();
        $schedule->setOriginalValue('host_manutenção');
        $schedule->setNewValue('host_manutenção');
        $schedule->setDateFrom($start);
        $schedule->setDateUntil($end);
        $schedule->setExecuted(false);
        $schedule->setReverted(false);
        $schedule->save();

        # create host_schedule
        $hostSchedule = new \HostSchedule();
        $hostSchedule->setDescription($post['description']);
        $hostSchedule->setScheduleId($schedule->getId());
        $hostSchedule->setHostId($host->getId());
        $hostSchedule->setUsuarioId($userid);
        $hostSchedule->setScheduled($now);
        $hostSchedule->setPushPop(b'1');
        $hostSchedule->setEnabled(b'1');

        $hostSchedule->save();

        return true;
    }
    public static function editarHostScheduleNotExecuted($post, $userid)
    {
        $hostSchedule = \HostScheduleQuery::create()->findOneById($post['schid']);
        if ($hostSchedule != NULL) {
            # cria o log, salva hora e id do usuário realizando a alteração.
            $log = new \Log();
            $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
            $log->setUsuarioId($userid);
            $log->save();

            # salva dados antes e depois da alteração
            $Editelog = new \LogEditHostSchedule();
            $Editelog->setHostScheduleId($hostSchedule->getId());
            $Editelog->setLogId($log->getId());

            $Editelog->setOldHostId($hostSchedule->getHostId());
            $Editelog->setNewHostId($hostSchedule->getHostId());

            $Editelog->setOldDataFrom($hostSchedule->getSchedule()->getDateFrom());
            $Editelog->setNewDateFrom(Carbon::parse($post['start'], 'America/Sao_Paulo')->getTimestamp());

            $Editelog->setOldDateUntil($hostSchedule->getSchedule()->getDateUntil());
            $Editelog->setNewDateUntil(Carbon::parse($post['end'], 'America/Sao_Paulo')->getTimestamp());

            $Editelog->setOldPushPop($hostSchedule->getPushPop());
            $Editelog->setNewPushPop($hostSchedule->getPushPop());

            $Editelog->save();

            # atualiza os dados 
            $hostSchedule->getSchedule()->setDateFrom(Carbon::parse($_POST['start'], 'America/Sao_Paulo')->getTimestamp());
            $hostSchedule->getSchedule()->setDateUntil(Carbon::parse($_POST['end'], 'America/Sao_Paulo')->getTimestamp());
            $hostSchedule->setDescription($_POST['descr']);
            $hostSchedule->getSchedule()->save();
            $hostSchedule->save();

            return true;
        } else {
            return false;
        }
    }
    public static function editarHostScheduleExecuted($post, $userid)
    {
        $hostSchedule = \HostScheduleQuery::create()->findOneById($post['schid']);
        if ($hostSchedule != NULL) {
            # cria o log, salva hora e id do usuário realizando a alteração.
            $log = new \Log();
            $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
            $log->setUsuarioId($userid);
            $log->save();

            # salva dados antes e depois da alteração
            $Editelog = new \LogEditHostSchedule();
            $Editelog->setHostScheduleId($hostSchedule->getId());
            $Editelog->setLogId($log->getId());

            $Editelog->setOldHostId($hostSchedule->getHostId());
            $Editelog->setNewHostId($hostSchedule->getHostId());

            $Editelog->setOldDataFrom($hostSchedule->getSchedule()->getDateFrom());
            $Editelog->setNewDateFrom($hostSchedule->getSchedule()->getDateFrom());

            $Editelog->setOldDateUntil($hostSchedule->getSchedule()->getDateUntil());
            $Editelog->setNewDateUntil(Carbon::parse($post['end'], 'America/Sao_Paulo')->getTimestamp());

            $Editelog->setOldPushPop($hostSchedule->getPushPop());
            $Editelog->setNewPushPop($hostSchedule->getPushPop());

            $Editelog->save();

            # atualiza os dados 
            $hostSchedule->getSchedule()->setDateUntil(Carbon::parse($_POST['end'], 'America/Sao_Paulo')->getTimestamp());
            $hostSchedule->getSchedule()->save();
            $hostSchedule->save();

            return true;
        } else {
            return false;
        }
    }
    public static function deletarHostSchedule($hostSchedule, $userid)
    {
        # cria o log, salva hora e id do usuário realizando a alteração.
        $log = new \Log();
        $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
        $log->setUsuarioId($userid);
        $log->save();

        # log delete
        $deleteLog = new \LogDeleteHostSchedule();
        $deleteLog->setHostScheduleId($hostSchedule->getId());
        $deleteLog->setLogId($log->getId());
        $deleteLog->save();

        # disable schedule 
        $hostSchedule->setEnabled(b'0');
        $hostSchedule->save();

        return true;
    }
}