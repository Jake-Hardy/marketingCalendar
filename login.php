<?php
require_once 'functions/users.functions.php';

$user = $_POST['username'];
if(isUser($user)) {
    echo 'true';
}
else {
    echo 'Invalid username';
}
?>
