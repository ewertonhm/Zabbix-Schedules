<?php
// inicia a sessão e verifica se está logado, se não estiver redireciona para login

use Carbon\Carbon;
use controller\ZabbixQuery;
use controller\Log;
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
        'page_name' => 'Logs',
    ];
    
    // TODO: Filtro por host/grupo

    if(isset($_GET['logtype'])){
        if($_GET['logtype'] == 'macro-all'){
            $vars['macro'] = Log::getMacroLog();
        }
        else if($_GET['logtype'] == 'macro-add'){
            $vars['macro'] = Log::getMacroAddLog();    
        }
        else if($_GET['logtype'] == 'macro-edit'){
            $vars['macro'] = Log::getMacroEditLog();
        }
        else if($_GET['logtype'] == 'macro-del'){
            $vars['macro'] = Log::getMacroDelLog();                
        }
        else if($_GET['logtype'] == 'macro-exec'){
            $vars['macro'] = Log::getMacroExecutionLog();   
        }
        else if($_GET['logtype'] == 'grupo-all'){
            $vars['grupo'] = Log::getGrupoLog();
        }
        else if($_GET['logtype'] == 'grupo-add'){
            $vars['grupo'] = Log::getGrupoAddLog();
        }
        else if($_GET['logtype'] == 'grupo-edit'){
            $vars['grupo'] = Log::getGrupoEditLog();                
        }
        else if($_GET['logtype'] == 'grupo-del'){
            $vars['grupo'] = Log::getGrupoDelLog();                
        }        
        else if($_GET['logtype'] == 'grupo-exec'){
            $vars['grupo'] = Log::getGrupoExecutionLog();
        }
    }

    $template = $twig->load('logs.twig');
        
    echo $template->render($vars);
}


?>