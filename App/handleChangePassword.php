<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function handleChangePassword()
{
    extract($_POST);

    $user = getUser($_SESSION["userId"]);

    if (hash("sha256", $password) != $user->password) return redirectWithMessage("/profile", "error", "Wrong password.");

    if (!validatePassword($newPassword, $passwordConfirm)) return redirect("/profile");

    updatePassword($newPassword);

    return redirectWithMessage("/profile", "success", "Password was updated.");
}