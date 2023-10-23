<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function removeRole($userId)
{
    $users = getUsers();

    $users[$userId]->role = "user";

    save($users);

    if ($_SESSION["userId"] == $userId) $_SESSION["role"] = "user";

    return redirectWithMessage("/manage-user-role/{$userId}", "info", "User role was removed.");
}