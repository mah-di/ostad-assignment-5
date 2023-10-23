<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function assignRole()
{
    extract($_POST);

    if ($role !== "")
    {
        $users = getUsers();

        $users[$userId]->role = $role;

        if ($userId == $_SESSION["userId"]) $_SESSION["role"] = $role;

        save($users);

        return redirectWithMessage("/manage-user-role/{$userId}", "info", "User role was updated.");
    }

    return redirect("/manage-user-role/{$userId}");
}