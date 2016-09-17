<?php
$dsn      = 'mysql:host=localhost;dbname=Marketing-Calendar;charset=utf8';
$username = 'root';
$password = '';
$db;

$db = new PDO($dsn, $username, $password);
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>
