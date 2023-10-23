<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function handleLogin()
{
    extract($_POST);

    if ($user = userExists($username, $password))
    {
        login($user);

        return redirect("/{$user->role}-area");
    }

    return redirectWithMessage("/login", "error", "UserName and Password doesn't match.");

}