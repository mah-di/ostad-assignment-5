<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function handleDelete($userId)
{
    $users = getUsers();

    if (array_key_exists($userId, $users))
    {
        unset($users[$userId]);

        save($users);

        $message = 'User was deleted.';
    }
    else $message = 'No such user exists.';

    return redirectWithMessage("/", "info", $message);
}