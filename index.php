<?php 
session_start();
$_SESSION['app_name'] = 'Washa'; 
// Include the initialization file which sets up necessary configurations and dependencies
require_once 'init.php';

// Set the timezone to Indonesian standard time using the DateHelper class
DateHelper::setIndonesianTimeZone();
DB::connect('localhost', 'washa', 'root', '');
// Instantiate the main application class
$app = new App();