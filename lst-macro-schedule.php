<?php
// inicia a sessão e verifica se está logado, se não estiver redireciona para login

use Carbon\Carbon;
use controller\ZabbixQuery;
use ScheduleQuery;

session_start();
if(!isset($_SESSION['logado']) OR $_SESSION['logado'] != true){
    header("location: login.php");
    die();
}
require_once 'config.php';

if(UsuarioQuery::create()->findOneById($_SESSION['id'])->getAdmin() != 1){
    echo 'Necessário ser admin para acessar essa página.';
} else {
    $vars = [
        'admin' => UsuarioQuery::create()->findOneById($_SESSION['id'])->getAdmin(),
        'page_name' => 'Alterar Macro',
    ];

    
    # ao acessar a pagina passando o id de um schedule como get, envia os dados para o twig para preencher o form de edição.
    if(isset($_GET['edite'])){
        $macroSchedule = MacroScheduleQuery::create()->findOneById($_GET['edite']);
        if($macroSchedule != NULL){
            if($macroSchedule->getEnabled() == 1){
                if(!$macroSchedule->getSchedule()->getExecuted()){
                    $vars['editar']['scheduleid'] = $macroSchedule->getId();
                    $vars['editar']['host'] = $macroSchedule->getHost()->getNome();
                    $vars['editar']['macro'] = $macroSchedule->getMacro()->getNome();
                    $vars['editar']['start'] = Carbon::createFromTimestamp($macroSchedule->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                    $vars['editar']['end'] = Carbon::createFromTimestamp($macroSchedule->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                    $vars['editar']['oldvalue'] = $macroSchedule->getSchedule()->getOriginalValue();
                    $vars['editar']['newvalue'] = $macroSchedule->getSchedule()->getNewValue();   
                } elseif($macroSchedule->getSchedule()->getExecuted() and !$macroSchedule->getSchedule()->getReverted()) {
                    $vars['editar']['scheduleid'] = $macroSchedule->getId();
                    $vars['editar']['host'] = $macroSchedule->getHost()->getNome();
                    $vars['editar']['macro'] = $macroSchedule->getMacro()->getNome();
                    $vars['editar']['startexecuted'] = Carbon::createFromTimestamp($macroSchedule->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                    $vars['editar']['end'] = Carbon::createFromTimestamp($macroSchedule->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                    $vars['editar']['oldvalue'] = $macroSchedule->getSchedule()->getOriginalValue();
                    $vars['editar']['newvalue'] = $macroSchedule->getSchedule()->getNewValue();   
                } else{
                    echo 'Schedule já executado, não é possível editar esse schedule.';
                }
            } else {
                echo 'Schedule desativado, você não tem permissão para editar esse schedule.';
            }
        } else {
            echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
        }
    } else if(isset($_GET['delete'])){
        $macroSchedule = MacroScheduleQuery::create()->findOneById($_GET['delete']);
        if($macroSchedule != NULL){
            if($macroSchedule->getEnabled() == 1){
                if(!$macroSchedule->getSchedule()->getExecuted()){
                    $vars['deletar']['scheduleid'] = $macroSchedule->getId();
                    $vars['deletar']['host'] = $macroSchedule->getHost()->getNome();
                    $vars['deletar']['macro'] = $macroSchedule->getMacro()->getNome();
                    $vars['deletar']['start'] = Carbon::createFromTimestamp($macroSchedule->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                    $vars['deletar']['end'] = Carbon::createFromTimestamp($macroSchedule->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                    $vars['deletar']['oldvalue'] = $macroSchedule->getSchedule()->getOriginalValue();
                    $vars['deletar']['newvalue'] = $macroSchedule->getSchedule()->getNewValue();   
                } else {
                    echo 'Schedule já executado, você não tem permissão para deletar esse schedule.';
                }
            } else {
                echo 'Schedule desativado, você não tem permissão para deletar esse schedule.';
            }
        } else {
            echo 'Schedule não existe ou você não tem permissão para deletar esse schedule.';
        }
    }

    # ao salvar uma edição:
    if(isset($_POST['editar'])){
        if(!controller\Macro::editeMacroScheduleNotExecuted($_POST,$_SESSION['id'])){
            echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
        }
    } elseif(isset($_POST['editar2'])){
        if(!controller\Macro::editeMacroScheduleExecuted($_POST,$_SESSION['id'])){
            echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
        }
    } else if(isset($_POST['deletar'])){
        $macroSchedule = MacroScheduleQuery::create()->findOneById($_POST['schid']);
        if($macroSchedule != NULL){
            # cria o log, salva hora e id do usuário realizando a alteração.
            $log = new Log();
            $log->setLogtime(Carbon::create()->now('America/Sao_Paulo')->getTimestamp());
            $log->setUsuarioId($_SESSION['id']);
            $log->save();

            # log delete
            $deleteLog = new LogDeleteMacroSchedule();
            $deleteLog->setMacroScheduleId($macroSchedule->getId());
            $deleteLog->setLogId($log->getId());
            $deleteLog->save();

            # disable schedule 
            $macroSchedule->setEnabled(b'0');
            $macroSchedule->save();
        } else {
            echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
        }
    }

    if(!isset($_GET['edite']) && !isset($_GET['delete'])){
        $macroSchedules = MacroScheduleQuery::create()->filterByEnabled(1)->find();
        $counter = 0;
    
        foreach($macroSchedules as $m){
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
    }
    $template = $twig->load('lst-macro-schedule.twig');
        
    echo $template->render($vars);

}

?>