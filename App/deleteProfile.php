<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function deleteProfile()
{
    extract($_POST);

    $users = getUsers();

    $user = $users[$_SESSION["userId"]];

    if (hash("sha256", $password) !== $user->password) return redirectWithMessage("/profile", "error", "Incorrect password.");

    unset($users[$_SESSION["userId"]]);

    save($users);

    require_once("logout.php");

    logout();
}