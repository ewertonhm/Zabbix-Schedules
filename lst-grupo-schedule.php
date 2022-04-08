<?php
// inicia a sessão e verifica se está logado, se não estiver redireciona para login

use Carbon\Carbon;
use controller\ZabbixQuery;
use ScheduleQuery;

session_start();
if (!isset($_SESSION['logado']) or $_SESSION['logado'] != true) {
    header("location: login.php");
    die();
}
require_once 'config.php';

$vars = [
    'admin' => UsuarioQuery::create()->findOneById($_SESSION['id'])->getAdmin(),
    'page_name' => 'Manutenções Agendadas',
];


# ao acessar a pagina passando o id de um schedule como get, envia os dados para o twig para preencher o form de edição.
if (isset($_GET['edite_grupo'])) {
    $grupoSchedule = GrupoScheduleQuery::create()->findOneById($_GET['edite_grupo']);
    if ($grupoSchedule != NULL) {
        if ($grupoSchedule->getEnabled() == 1) {
            if (!$grupoSchedule->getSchedule()->getExecuted()) {
                $vars['editar_grupo']['scheduleid'] = $grupoSchedule->getId();
                $vars['editar_grupo']['grupo'] = $grupoSchedule->getGrupo()->getNome();
                $vars['editar_grupo']['descr'] = $grupoSchedule->getDescription();
                $vars['editar_grupo']['start'] = Carbon::createFromTimestamp($grupoSchedule->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                $vars['editar_grupo']['end'] = Carbon::createFromTimestamp($grupoSchedule->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
            } else {
                $vars['editar_grupo']['executed'] = true;
                $vars['editar_grupo']['scheduleid'] = $grupoSchedule->getId();
                $vars['editar_grupo']['grupo'] = $grupoSchedule->getGrupo()->getNome();
                $vars['editar_grupo']['descr'] = $grupoSchedule->getDescription();
                $vars['editar_grupo']['start'] = Carbon::createFromTimestamp($grupoSchedule->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                $vars['editar_grupo']['end'] = Carbon::createFromTimestamp($grupoSchedule->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
            }
        } else {
            echo 'Schedule desativado, você não tem permissão para editar esse schedule.';
        }
    } else {
        echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
    }
} else if (isset($_GET['edite_host'])) {
    $hostSchedule = HostScheduleQuery::create()->findOneById($_GET['edite_host']);
    if ($hostSchedule != NULL) {
        if ($hostSchedule->getEnabled() == 1) {
            if (!$hostSchedule->getSchedule()->getExecuted()) {
                $vars['editar_host']['scheduleid'] = $hostSchedule->getId();
                $vars['editar_host']['host'] = $hostSchedule->getHost()->getNome();
                $vars['editar_host']['descr'] = $hostSchedule->getDescription();
                $vars['editar_host']['start'] = Carbon::createFromTimestamp($hostSchedule->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                $vars['editar_host']['end'] = Carbon::createFromTimestamp($hostSchedule->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
            } else {
                $vars['editar_host']['executed'] = true;
                $vars['editar_host']['scheduleid'] = $hostSchedule->getId();
                $vars['editar_host']['host'] = $hostSchedule->getHost()->getNome();
                $vars['editar_host']['descr'] = $hostSchedule->getDescription();
                $vars['editar_host']['start'] = Carbon::createFromTimestamp($hostSchedule->getSchedule()->getDateFrom(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
                $vars['editar_host']['end'] = Carbon::createFromTimestamp($hostSchedule->getSchedule()->getDateUntil(), 'America/Sao_Paulo')->format('Y-m-d\TH:i:s');
            }
        } else {
            echo 'Schedule desativado, você não tem permissão para editar esse schedule.';
        }
    } else {
        echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
    }
} else if (isset($_GET['delete'])) {
    $macroSchedule = MacroScheduleQuery::create()->findOneById($_GET['delete']);
    if ($macroSchedule != NULL) {
        if ($macroSchedule->getEnabled() == 1) {
            if (!$macroSchedule->getSchedule()->getExecuted()) {
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
if (isset($_POST['editar_grupo'])) {
    $grupoSchedule = \GrupoScheduleQuery::create()->findOneById($_POST['schid']);
    if ($grupoSchedule != null) {
        if (!$grupoSchedule->getSchedule()->getExecuted() && !$grupoSchedule->getSchedule()->getReverted()) {
            if (controller\GrupoScheduler::editarGrupoScheduleNotExecuted($_POST, $_SESSION['id'])) {
                echo 'Schedule Editado com sucesso.';
                $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
            } else {
                echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
            }
        } elseif ($grupoSchedule->getSchedule()->getExecuted() && !$grupoSchedule->getSchedule()->getReverted()) {
            if (controller\GrupoScheduler::editarGrupoScheduleExecuted($_POST, $_SESSION['id'])) {
                echo 'Schedule Editado com sucesso.';
                $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
            } else {
                echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
            }
        }
    }
} else if (isset($_POST['editar_host'])) {
    $hostSchedule = \HostScheduleQuery::create()->findOneById($_POST['schid']);
    if ($hostSchedule != null) {
        if (!$hostSchedule->getSchedule()->getExecuted() && !$hostSchedule->getSchedule()->getReverted()) {
            if (controller\HostScheduler::editarHostScheduleNotExecuted($_POST, $_SESSION['id'])) {
                echo 'Schedule Editado com sucesso.';
                $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
            } else {
                echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
            }
        } elseif ($hostSchedule->getSchedule()->getExecuted() && !$hostSchedule->getSchedule()->getReverted()) {
            if (controller\HostScheduler::editarHostScheduleExecuted($_POST, $_SESSION['id'])) {
                echo 'Schedule Editado com sucesso.';
                $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
            } else {
                echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
            }
        }
    }
} else if (isset($_GET['delete_grupo'])) {
    $grupoSchedule = \GrupoScheduleQuery::create()->findOneById($_GET['delete_grupo']);
    if ($grupoSchedule != null) {
        if (!$grupoSchedule->getSchedule()->getExecuted() && !$grupoSchedule->getSchedule()->getReverted()) {
            if (controller\GrupoScheduler::deletarGrupoSchedule($grupoSchedule, $_SESSION['id'])) {
                echo "Schedule deletado com sucesso.";
                $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
            }
        } else {
            echo "Schedule já executado, não é possível deletar.";
            $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
        }
    } else {
        echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
    }
} else if (isset($_GET['delete_host'])) {
    $hostSchedule = \HostScheduleQuery::create()->findOneById($_GET['delete_host']);
    if ($hostSchedule != null) {
        if (!$hostSchedule->getSchedule()->getExecuted() && !$hostSchedule->getSchedule()->getReverted()) {
            if (controller\HostScheduler::deletarHostSchedule($hostSchedule, $_SESSION['id'])) {
                echo "Schedule deletado com sucesso.";
                $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
            }
        } else {
            echo "Schedule já executado, não é possível deletar.";
            $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
        }
    } else {
        echo 'Schedule não existe ou você não tem permissão para editar esse schedule.';
    }
}

if (!isset($_GET['edite_grupo']) && !isset($_GET['delete_grupo']) && !isset($_GET['edite_host']) && !isset($_GET['delete_host'])) {
    $vars['schedule'] = controller\HostGrupoScheduleManager::getScheduledMaintenances();
}
$template = $twig->load('lst-grupo-schedule.twig');

echo $template->render($vars);