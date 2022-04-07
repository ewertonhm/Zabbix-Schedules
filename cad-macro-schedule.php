<?php
// inicia a sessão e verifica se está logado, se não estiver redireciona para login

use Carbon\Carbon;
use controller\ZabbixQuery;
use ScheduleQuery;
use Symfony\Component\Validator\Constraints\Timezone;

session_start();
if(!isset($_SESSION['logado']) OR $_SESSION['logado'] != true){
    header("location: login.php");
    die();
}
require_once 'config.php';

$vars = [
    'admin' => UsuarioQuery::create()->findOneById($_SESSION['id'])->getAdmin(),
    'page_name' => 'Alterar Macro',
];

# Coleta os macros que estão com status enabled e que foram criados pelo usuário que está logado
$vars['schedule'] = controller\Macro::getUserCreatedMacros($_SESSION['id']);

# ao acessar a pagina passando o id de um schedule como get, envia os dados para o twig para preencher o form de edição.
if(isset($_GET['edite'])){
    $macroSchedule = MacroScheduleQuery::create()->filterByUsuarioId($_SESSION['id'])->findOneById($_GET['edite']);
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
}

if(isset($_POST['agendar'])){
    # ULTIMO ACESSO, após preencher formulário e clicar em agendar
    $vars['created'] = controller\Macro::scheduleMacroSchedule($_POST,$_SESSION['id']);
}

if(isset($_POST['host']) AND $_POST['host'] != ''){
    # SEGUNDO ACESSO, após selecionar o HOST
    $re = '/(.*)(\s\[\w*\=)(\d*)(\])/m';
    $str = $_POST['host'];

    preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

    // Print the entire match result
    if($matches != null){
        $macros = ZabbixQuery::getMacros($matches[0][3]);
        if(count($macros) > 0){
            $vars['macros'] = $macros;
        } else {
            $vars['nomacros'] = true;
        }

        $vars['hostid'] = $matches[0][3];
    } else {
        $vars['hosterror'] = true;
    }
} elseif (isset($_POST['hostid']) AND isset($_POST['macro'])){
    # TERCEIRO ACESSO, após selecionar o host E o macro
    $vars['macro'] = ZabbixQuery::getMacro($_POST['macro']);
} else {
    # PRIMEIRO ACESSO, antes de selecionar o host
    $vars['hosts'] = ZabbixQuery::getHosts();
}

if(isset($vars['hosterror']) OR isset($vars['nomacros'])){
    # CASO O HOST SELECIONADO NÃO EXISTA OU NÃO TENHA MACROS
    $vars['hosts'] = ZabbixQuery::getHosts();
}

$template = $twig->load('cad-macro-schedule.twig');
    
echo $template->render($vars);

?>