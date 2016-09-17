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
    <?php if(isset($_POST['id'])) : ?>
        <input type="hidden" class="idHook" value=<?php echo $_POST['id']; ?> />
        <input type="hidden" class="loadFlag" value="true" />
    <?php endif; ?>
    <?php if(isset($_SESSION['user'])) : ?>
        <input type="hidden" class="userHook" value=<?php echo $_SESSION['user']; ?> />
    <?php endif; ?>
    <div class="header">
        <?php if ($page == 'calendar') : ?>
            <ul class="calendar-options">
                <li class="nav--item buttonOptions">Calendar Options</li>
                <li class="nav--item"><a href="index.php?action=create-calendar">New Calendar</a></li>
                <!-- <li class="nav--item buttonLoad"><a href="select_calendar.php">Load Calendar</a></li> -->
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav--item buttonSave">Save Calendar</li>
                    <li class="nav--item buttonLoad">Load Calendar</li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
        <ul class="header--nav">
            <li class="nav--item"><a href="index.php">Home</a></li>
            <!-- <?php //if (isset($_SESSION['user'])): ?>
                <li class="nav--item"><?php echo $_SESSION['user']; ?></li>
                <li class="nav--item buttonLogout">Logout</li>
            <?php //else: ?>
                <li class="nav--item buttonLogin">Login</li>
            <?php //endif; ?> -->
        </ul>
    </div>
