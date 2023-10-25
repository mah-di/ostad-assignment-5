<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function updateProfile()
{
    extract($_POST);

    $validData = true;

    if ($username == $_SESSION["username"] && $email == $_SESSION["email"]) return redirect("/profile");

    if (isEmptyData($username, $email)) $validData = false;

    if ($username !== $_SESSION["username"] && !validateUsername($username)) $validData = false;

    if ($email !== $_SESSION["email"] && !validateEmail($email)) $validData = false;

    if (!$validData) return redirect("/profile");

    updateUser($username, $email);

    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;

    return redirectWithMessage("/profile", "success", "Profile info was updated!!");
}