<?php
$dsn='mysql:host='.$_SERVER['SERVER_NAME'].';dbname=files_system';
$dbUsername = "root";
$dbPassword = "";

$db = new PDO($dsn, $dbUsername, $dbPassword);