<?php
$page = register;
include 'view/header.php';
?>

<form action="index.php" method="post">
    <div class="form--item">
        <label for="username">Username</label>
        <input type="text" name="username" />
    </div>

    <div class="form--item">
        <label for="email">Email Address</label>
        <input type="email" name="email" />
        <input type="hidden" name="action" value="register" />
    </div>

    <input type="submit" class="button button__register" />
</form>
