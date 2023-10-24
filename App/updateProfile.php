<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function updateProfile()
{
    extract($_POST);

    $validData = true;

    if ($username == $_SESSION["username"] && $email == $_SESSION["email"]) return redirect("/profile");

    if ($username == "" || $email == "")
    {
        $validData = false;

        setMessage("error", "Both fields are required.");
    }
    
    if ($username !== $_SESSION["username"] && usernameExists($username))
    {
        $validData = false;

        setMessage("error", "This UserName is already taken.");
    }
    
    if ($email !== $_SESSION["email"] && emailExists($email))
    {
        $validData = false;

        setMessage("error", "This Email is already registered.");
    }

    if (!$validData) return redirect("/profile");

    updateUser($username, $email);

    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;

    return redirectWithMessage("/profile", "success", "Profile info was updated!!");
}