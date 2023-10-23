<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function updateProfile()
{
    extract($_POST);

    if ($username == $_SESSION["username"] && $email == $_SESSION["email"]) return redirect("/profile");

    if ($username == "" || $email == "") return redirectWithMessage("/profile", "error", "Both fields are required.");

    if ($username !== $_SESSION["username"] && usernameExists($username)) return redirectWithMessage("/profile", "error", "This UserName is already taken.");

    if ($email !== $_SESSION["email"] && emailExists($email)) return redirectWithMessage("/profile", "error", "This Email is already registered.");

    updateUser($username, $email);

    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;

    return redirectWithMessage("/profile", "success", "Profile info was updated!!");
}