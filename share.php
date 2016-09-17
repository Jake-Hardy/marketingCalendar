<?php
require_once 'model/Database.php';
require_once 'functions/calendar_storage.php';
require_once 'functions/users.functions.php';

$user = $_POST['user'];
$id = $_POST['id'];

grantPermissions($user, $id);
?>
