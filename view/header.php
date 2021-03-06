<?php
ini_set('display_errors', 0);
session_start();
// $_SESSION['user'] = 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Calendar</title>
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/load-style.css" rel="stylesheet" />
</head>
<body>
    <?php if (isset($_POST['id'])): ?>
        <input type="hidden" class="idHook" value=<?php echo $_POST['id']; ?> />
        <input type="hidden" class="loadFlag" value="true" />
    <?php endif; ?>
    <input type="hidden" class="userHook" value="user" />
    <div class="header">
        <?php if ($page == 'calendar'): ?>
            <ul class="calendar-options">
                <li class="nav--item buttonOptions">Calendar Options</li>
                <li class="nav--item"><a href="index.php?action=create-calendar">New Calendar</a></li>
                <li class="nav--item buttonSave">Save Calendar</li>
                <li class="nav--item buttonLoad">Load Calendar</li>
            </ul>
        <?php endif; ?>
        <ul class="header--nav">
            <li class="nav--item"><a href="index.php">Home</a></li>
        </ul>
    </div>
