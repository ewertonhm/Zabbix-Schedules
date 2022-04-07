<?php
// inicia a sessão e verifica se está logado, se não estiver redireciona para login
session_start();
if(!isset($_SESSION['logado']) OR $_SESSION['logado'] != true){
    header("location: login.php");
    die();
}
require_once 'config.php';

$vars = [
    'admin' => UsuarioQuery::create()->findOneById($_SESSION['id'])->getAdmin()
];



$template = $twig->load('inicio.twig');

echo $template->render($vars);