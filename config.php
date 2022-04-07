<?php

// setup the autoloading
require_once 'vendor/autoload.php';
// setup Propel
require_once 'generated-conf/config.php';


use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Propel\Runtime\Propel;

//setup whoops
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

//setup twig
$loader = new \Twig\Loader\FilesystemLoader('classes/Views');
$twig = new \Twig\Environment($loader, [
    //'cache' => 'App/TwigTemplates/compilation_cache', //descomentar após o desenvolvimento
    'debug' => true, //comentar após o desenvolvimento
]);
// comentar após o desenvolvimento
$twig->addExtension(new \Twig\Extension\DebugExtension());

$logger = new Logger('defaultLogger');
$logger->pushHandler(new StreamHandler('php://stderr'));
#Propel::getServiceContainer()->setLogger('defaultLogger', $logger);