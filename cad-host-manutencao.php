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

if(isset($_POST['group'])){
    # Após selecionar o grupo/host bate aqui para filtrar os dados dele 
    $re = '/(.*)(\s\[\w*\=)(\d*)(\])/m';
    $str = $_POST['group'];

    preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);


    if($matches != null){
        if($matches[0][2] == ' [hostid='){
            $vars['host']['nome'] = $matches[0][1];
            $vars['host']['id'] = $matches[0][3];

        } elseif($matches[0][2] == ' [groupid='){
            $hosts = ZabbixQuery::getHostGroupsWithHosts($matches[0][3]);
            if(isset($hosts[0]['hosts']) && count($hosts[0]['hosts']) > 0){
                $vars['group']['nome'] = $matches[0][1];
                $vars['group']['id'] = $matches[0][3];
                $vars['group']['hosts'] = $hosts[0]['hosts'];
            } else {
                $vars['nohosts'] = true;
            }
        }
    } else {
        $vars['grouperror'] = true;
    }
} elseif(isset($_POST['agendar_grupo'])){
    # ULTIMO ACESSO, após preencher formulário e clicar em agendar
    # verificar se o grupo existe no banco, se não cria
    if(controller\GrupoScheduler::cadastrarGrupoSchedule($_POST, $_SESSION['id'])){
        $vars['created'] = true;
        $vars['groups'] = ZabbixQuery::getHostGroups();
        $vars['hosts'] = ZabbixQuery::getHosts();
    }
} elseif(isset($_POST['agendar_host'])){
    # ULTIMO ACESSO, após preencher formulário e clicar em agendar
    if(controller\HostScheduler::cadastrarHostSchedule($_POST,$_SESSION['id'])){
        $vars['created'] = true;
        $vars['groups'] = ZabbixQuery::getHostGroups();
        $vars['hosts'] = ZabbixQuery::getHosts();
    }
} else {
    # PRIMEIRO ACESSO, antes de selecionar o host
    $vars['groups'] = ZabbixQuery::getHostGroups();
    $vars['hosts'] = ZabbixQuery::getHosts();
}


if(isset($vars['grouperror']) OR isset($vars['nohosts'])){
    # CASO O GRUPO SELECIONADO NÃO EXISTA OU NÃO TENHA HOSTS
    $vars['groups'] = ZabbixQuery::getHostGroups();
    $vars['hosts'] = ZabbixQuery::getHosts();
}


$template = $twig->load('cad-host-manutencao.twig');
    
echo $template->render($vars);

?>