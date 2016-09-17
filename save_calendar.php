<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'functions/calendar_storage.php';

    $calendar = $_POST;
    $calendar_info['rows']    = $calendar['rows'];
    $calendar_info['cols']    = $calendar['cols'];
    $calendar_info['title']   = $calendar['title'];
    $calendar_info['owner']   = $calendar['owner'];

    $cells = array_slice($calendar, 4);
    $statement = tableExists($calendar_info['title'], $calendar_info['owner']);

    // If a calendar with the same title and owner does not exist, create a new entry,
    // otherwise update existing calendar
    if($statement->rowCount() > 0) {
        overwriteCells($statement, $calendar_info, $cells, $owner);
    } else {
        saveCalendar($calendar_info, $cells);
    }
?>
