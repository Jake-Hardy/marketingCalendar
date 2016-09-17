<?php
require_once 'config.php';
require_once 'model/Database.class.php';

function isUser($username) {
    $db = Database::connect();

    $query = "SELECT username FROM users
              WHERE username = :u
              LIMIT 1";
    $statement = $db->prepare($query);
    $statement->bindValue(":u", $username);
    $statement->execute();
    if($statement->rowCount() > 0) {
        return true;
    }
    else {
        return false;
    }
}

function isUserByEmail($email) {
    $db = Database::connect();

    $query = "SELECT email FROM users
              WHERE email = :e
              LIMIT 1";
    $statement = $db->prepare($query);
    $statement->bindValue(":e", $email);
    $statement->execute();
    if($statement->rowCount() > 0) {
        return true;
    }
    else {
        return false;
    }
}

function getUser($username) {
    $db = Database::connect();

    $query = "SELECT username FROM users
              WHERE username = :u
              LIMIT 1";
    $statement = $db->prepare($query);
    $statement->bindValue(":u", $username);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $user;
}

function getUserByEmail($email) {
    $db = Database::connect();

    $query = "SELECT email FROM users
              WHERE email = :e
              LIMIT 1";
    $statement = $db->prepare($query);
    $statement->bindValue(":e", $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $user;
}

function register($user, $email) {
    $db = Database::connect();

    if (!isUserByEmail($email)) {
        $query = "INSERT INTO users
                  VALUES
                  (:u, :e)";
        $statement = $db->prepare($query);
        $statement->bindValue(":u", $user);
        $statement->bindValue(":e", $email);
        $statement->execute();
        $statement->closeCursor();

        $status = 'success';
    }
    else {
        $status = 'failed';
    }

    return $status;
}

function getAllUsers() {
    $db = Database::connect();
    $query = "SELECT username FROM users";
    $statement = $db->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $users;
}

function grantPermissions($user, $id) {
    $db = Database::connect();

    $query = "INSERT INTO sharedcals
              VALUES
              (:i, :u)";
    $statement = $db->prepare($query);
    $statement->bindValue(":i", $id);
    $statement->bindValue(":u", $user);
    $statement->execute();
    $statement->closeCursor();
}
?>
