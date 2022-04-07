<?php

namespace controller;

use Carbon\Carbon;
use \GrupoScheduleQuery;
use \HostScheduleQuery;

class HostGrupoScheduleManager
{
    static public function getScheduledMaintenances()
    {
        $grupoSchedule = GrupoScheduleQuery::create()->filterByEnabled(1)->find();
        $hostSchedule = HostScheduleQuery::create()->filterByEnabled(1)->find();

        $counter = 0;
        foreach($grupoSchedule as $m){
            $vars['schedule'][$counter]['id'] = $m->getId();
            $vars['schedule'][$counter]['descricao'] = $m->getDescription();
            $vars['schedule'][$counter]['scheduled'] = Carbon::createFromTimestamp($m->getScheduled(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['usuario'] = $m->getUsuario()->getLogin();
            $vars['schedule'][$counter]['grupo'] = $m->getGrupo()->getNome();
            $vars['schedule'][$counter]['schedule']['from'] = Carbon::createFromTimestamp($m->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['schedule']['until'] = Carbon::createFromTimestamp($m->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['schedule']['executed'] = $m->getSchedule()->getExecuted();
            $vars['schedule'][$counter]['schedule']['reverted'] = $m->getSchedule()->getReverted();
            $counter++;
        }
        foreach($hostSchedule as $m){
            $vars['schedule'][$counter]['id'] = $m->getId();
            $vars['schedule'][$counter]['descricao'] = $m->getDescription();
            $vars['schedule'][$counter]['scheduled'] = Carbon::createFromTimestamp($m->getScheduled(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['usuario'] = $m->getUsuario()->getLogin();
            $vars['schedule'][$counter]['host'] = $m->getHost()->getNome();
            $vars['schedule'][$counter]['schedule']['from'] = Carbon::createFromTimestamp($m->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['schedule']['until'] = Carbon::createFromTimestamp($m->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->toDateTimeString();
            $vars['schedule'][$counter]['schedule']['executed'] = $m->getSchedule()->getExecuted();
            $vars['schedule'][$counter]['schedule']['reverted'] = $m->getSchedule()->getReverted();
            $counter++;
        }
        $vars['schedule'] = DateTimeSorter::SortArray($vars['schedule'], 'scheduled');
        if(isset($vars['schedule'])){
            return $vars['schedule'];
        }
    }
    
}