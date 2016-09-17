<?php
require_once 'config.php';
require_once 'model/Database.class.php';
//require_once '../model/Database.php' //this is going to slowly be phased out and replaced with a class
/** TODO: retrieveCalendars and getTable could (should) have their names changed to
          getCalendars and getCalendar, respectively**/
function retrieveCalendars($username) {
    $db = Database::connect();

    $query = "SELECT * FROM calendars
              WHERE id in
              (SELECT id from sharedcals
              WHERE accessibleBy = :u)
              || owner = :u";
    $statement = $db->prepare($query);
    $statement->bindValue(":u", $username);
    $statement->execute();
    $calendars = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $calendars;
}

function getTable($id) {
    $db = Database::connect();

    $query = "SELECT * FROM calendars
              WHERE id=:id
              LIMIT 1";
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $table = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $table;
}

function getCells($id) {
    $db = Database::connect();

    $query = "SELECT * FROM cells
              WHERE id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $cells = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $cells;
}

function deleteCells($id) {
    $db = Database::connect();

    $query = "DELETE FROM cells WHERE id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $statement->closeCursor();
}

function updateCalendar($rows, $cols, $id, $owner) {
    $db = Database::connect();

    $query = "UPDATE calendars
              SET rows=:rows, cols=:cols, lastEditedDate=NOW(), lastEditedBy=:u
              WHERE id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(":rows", $rows);
    $statement->bindValue(":cols", $cols);
    $statement->bindValue(":u", $owner);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $statement->closeCursor();
}

function deleteCalendar($id) {
    $db = Database::connect();

    $query = "DELETE FROM calendars WHERE id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $statement->closeCursor();

    deleteCells($id, $db);
}

function tableExists($title, $owner) {
    $db = Database::connect();

    // Check to see if a table exists in the table with the same title and owner
    $query = "SELECT calendars.id FROM calendars
              WHERE owner=:o AND title=:title";
    $statement = $db->prepare($query);
    $statement->bindValue(":title", $title, PDO::PARAM_STR);
    $statement->bindValue(":o", $owner);
    $statement->execute();

    return $statement;
}

function insertCells($cells, $id) {
    $db = Database::connect();

    foreach($cells as $cell) {
        $query = "INSERT INTO cells
                  VALUES
                  (:id, :row, :col, :content)";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->bindValue(":row", $cell['row']);
        $statement->bindValue(":col", $cell['col']);
        $statement->bindValue(":content", $cell['content']);
        $statement->execute();
        $statement->closeCursor();
    }
}

function overwriteCells($statement, $calendar_info, $cells) {
    $result = $statement->fetchObject();
    $id = $result->id;
    $statement->closeCursor();

    deleteCells($id);
    updateCalendar($calendar_info['rows'], $calendar_info['cols'], $id, $owner);
    insertCells($cells, $id);
}

function saveCalendar($calendar_info, $cells) {
    $db = Database::connect();

    $query = "INSERT INTO calendars
              VALUES
              (0, :title, :rows, :cols, :o, NOW(), :e, NOW())";
    $statement = $db->prepare($query);
    $statement->bindValue(":rows", $calendar_info['rows']);
    $statement->bindValue(":cols", $calendar_info['cols']);
    $statement->bindValue(":o", $calendar_info['owner']);
    $statement->bindValue(":title", $calendar_info['title']);
    $statement->bindValue(":e", $calendar_info['owner']);
    $statement->execute();
    //$id = $db->query("SELECT LAST_INSERT_ID()");
    $id = $db->lastInsertId();
    $statement->closeCursor();

    insertCells($cells, $id);
}
?>
