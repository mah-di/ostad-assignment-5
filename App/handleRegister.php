<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function handleRegister()
{
    extract($_POST);

    if (!checkValidation($username, $email, $password, $passwordConfirm)) return redirect("/register");

    $user = register();

    login($user);

    return redirect("/user-area");
}
