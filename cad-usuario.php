<?php
// inicia a sessão e verifica se está logado, se não estiver redireciona para login
session_start();
if(!isset($_SESSION['logado']) OR $_SESSION['logado'] != true){
    header("location: login.php");
    die();
}
require_once 'config.php';

if(UsuarioQuery::create()->findOneById($_SESSION['id'])->getAdmin() != 1){
    echo 'Necessário ser admin para acessar essa página.';
} else {
    if(isset($_POST['cadastrar']) and $_POST['email'] != '' and $_POST['email'] != NULL){
        $usuario = new Usuario();
        $usuario->setNome($_POST['nome']);
        $usuario->setLogin($_POST['email']);
        $usuario->setSenha(md5($_POST['senha']));
        if(isset($_POST['admin']) && $_POST['admin'] == 'on'){
            $usuario->setAdmin('1');
        } else {
            $usuario->setAdmin('0');
        }
        if(isset($_POST['status']) && $_POST['status'] == 'on'){
            $usuario->setEnabled('1');
        } else {
            $usuario->setEnabled('0');
        }
        $usuario->save();

    }
    if(isset($_POST['editar']) and $_POST['email'] != '' and $_POST['email'] != NULL){
        $usuario = UsuarioQuery::create()->findOneById($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setLogin($_POST['email']);
        if(isset($_POST['admin']) && $_POST['admin'] == 'on'){
            $usuario->setAdmin('1');
        } else {
            $usuario->setAdmin('0');
        }
        if(isset($_POST['status']) && $_POST['status'] == 'on'){
            $usuario->setEnabled('1');
        } else {
            $usuario->setEnabled('0');
        }
        $usuario->save();
    }
    
    if(isset($_GET['delete']) and $_GET['delete'] != '' and $_GET['delete'] != NULL){
        $usuario = UsuarioQuery::create()->findOneById( $_GET['delete']);
        echo('Usuario='.$usuario->getLogin().', ID='.$usuario->getId().', Sucessful Deleted');
        $usuario->delete();
    }
    
    $vars = [
        'admin' => UsuarioQuery::create()->findOneById($_SESSION['id'])->getAdmin(),
        'page_name' => 'Cadastro de Usuários'
    ];
    
    
    if(isset($_GET['edite']) and $_GET['edite'] != '' and $_GET['edite'] != NULL){
        $usuario = UsuarioQuery::create()->findOneById($_GET['edite']);
        $vars['editar']['nome'] = $usuario->getNome();
        $vars['editar']['email'] = $usuario->getLogin();
        $vars['editar']['id'] = $usuario->getId();
        $vars['editar']['admin'] = $usuario->getAdmin();
        $vars['editar']['status'] = $usuario->getEnabled();
    }
    
    $usuarios = UsuarioQuery::create()->orderById()->find();
    
    $counter = 0;
    foreach ($usuarios as $usuario){
        $vars['usuarios'][$counter]['id'] = $usuario->getId();
        $vars['usuarios'][$counter]['email'] = $usuario->getLogin();
        $vars['usuarios'][$counter]['admin'] = $usuario->getAdmin();
    
        $counter++;
    }
    
    
    $template = $twig->load('cad-usuario.twig');
    
    echo $template->render($vars);
}
