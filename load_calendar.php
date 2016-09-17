<?php
require_once 'model/Database.php';
require_once 'functions/calendar_storage.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];

$table = getTable($id);
$cells = getCells($id);
$calendar = [$table, $cells];

echo json_encode($calendar, JSON_FORCE_OBJECT);
?>
