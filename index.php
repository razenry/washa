<?php 
session_start();
$_SESSION['app_name'] = 'Washa'; 

require_once 'init.php';

DateHelper::setIndonesianTimeZone();
DB::connect('localhost', 'washa', 'root', '');

$app = new App();