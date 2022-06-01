<?php

chdir('/var/www/zbx-schedule/');

use Carbon\Carbon;
use controller\ZabbixQuery;
use controller\Scheduler;

require_once 'config.php';


$scheduler = new Scheduler();
$scheduler->run();
echo "OK";
