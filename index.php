<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'functions/users.functions.php';

if(isset($_POST['action'])) {
    $action = $_POST['action'];
}
elseif(isset($_GET['action'])) {
    $action = $_GET['action'];
}
else {
    $action = 'create-calendar';
}

switch($action) {
    case 'create-calendar':
        $page = 'calendar';
        include 'create-calendar.php';
        break;
    case 'edit':
        $page = 'calendar';
        $id = $_POST['id'];
        include 'create-calendar.php';
        break;
    case 'login':
        $page = 'calendar';
        $user = $_POST['username'];

        session_start();
        $_SESSION['user'] = $user;
        include 'create-calendar.php';

        break;
    case 'register':
        $username = $_POST['username'];
        $email = $_POST['email'];

        if ($username != '' && $email != '') {
            $status = register($username, $email);
            if ($status == 'success') {
                session_start();
                $_SESSION['user'] = $username;
                $page = 'calendar';
                include 'create-calendar.php';
            }
            else {
                $page = 'calendar';
                $errors = 'A user is already registered with that email address.';
                include 'create-calendar.php';
            }
        }
        else {
            $page = 'calendar';
            $errors = "Username or Email field was left empty. Please try again.";
            include 'create-calendar.php';
        }

        break;
}

?>
