<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function handleLogin()
{
    extract($_POST);

    if ($user = userExists($email, $password))
    {
        login($user);

        return redirect("/{$user->role}-area");
    }

    return redirectWithMessage("/login", "error", "Email and Password doesn't match.");

}