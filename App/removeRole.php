<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function removeRole($userId)
{
    $users = getUsers();

    if (!array_key_exists($userId, $users)) return redirectWithMessage("/", "info", "No such user exists.");

    $users[$userId]->role = "user";

    save($users);

    if ($_SESSION["userId"] == $userId) $_SESSION["role"] = "user";

    return redirectWithMessage("/manage-user-role/{$userId}", "info", "User role was removed.");
}