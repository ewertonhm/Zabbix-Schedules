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
        'page_name' => 'Macros',
    ];

    $macros = MacroQuery::create()->find();

    $counter = 0;
    foreach($macros as $macro){
        $vars['macros'][$counter]['id'] = $macro->getId();
        $vars['macros'][$counter]['nome'] = $macro->getNome();
        $vars['macros'][$counter]['zabbixid'] = $macro->getZabbixid();
        $counter++;
    }

    $template = $twig->load('lst-macros.twig');
        
    echo $template->render($vars);

}

?>