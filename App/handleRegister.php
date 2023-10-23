<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function handleRegister()
{
    extract($_POST);

    if ($password !== $passwordConfirm)
    {
        return validationError("/register", "Passwords doesn't match.", $username, $email);
    }

    if ($username == "" || $email == "" || $password == "" || $passwordConfirm == "")
    {
        return validationError("/register", "All fields are required.", $username, $email);
    }

    if (usernameExists($username))
    {
        return validationError("/register", "The username is taken.", $username, $email);
    }

    if (usernameExists($email))
    {
        return validationError("/register", "The email is taken.", $username, $email);
    }

    $user = register();

    login($user);

    return redirect("/user-area");
}
