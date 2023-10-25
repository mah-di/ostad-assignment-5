<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

session_start();

if ($_SERVER['REQUEST_URI'] == '/')
{
    view('home');

    return;
}

$path = getPath();

$method = $_SERVER["REQUEST_METHOD"];

if ($path == '/register')
{
    if (isLoggedIn()) return redirect("/");
    
    if ($method == "GET") authView('register');
    
    if ($method == 'POST')
    {
        require_once("App".DIRECTORY_SEPARATOR."handleRegister.php");

        handleRegister();
    }

    return;
}

elseif ($path == '/login')
{
    if (isLoggedIn()) return redirect("/");

    if ($method == "GET") authView('login');

    if ($method == 'POST')
    {
        require_once("App".DIRECTORY_SEPARATOR."handleLogin.php");

        handleLogin();
    }

    return;
}

elseif ($path == '/logout')
{
    if (!isLoggedIn()) return redirectWithMessage("/", "info", "Invalid Request.");

    require_once("App".DIRECTORY_SEPARATOR."logout.php");

    logout();

    return;
}

elseif ($path == '/profile')
{
    if (!isLoggedIn()) return redirectWithMessage("/", "info", "Invalid Request.");

    if ($method == "GET") view('profile');

    if ($method == "POST")
    {
        require_once("App".DIRECTORY_SEPARATOR."updateProfile.php");

        updateProfile();
    }

    return;
}

elseif ($path == "/profile/update/password")
{
    if (!isLoggedIn()) return redirectWithMessage("/", "info", "Invalid Request");

    if ($method == "POST")
    {
        require_once("App".DIRECTORY_SEPARATOR."handleChangePassword.php");

        handleChangePassword();

        return;
    }
}

elseif (str_starts_with($path, "/delete/"))
{
    if (!isLoggedIn() || $_SESSION["role"] !== "admin") return redirectWithMessage("/", "info", "Invalid Request.");
    
    $pathParams = explode("/delete/", $path);
    
    $userId = end($pathParams);

    if ($userId == $_SESSION["userId"]) return redirect("/profile#delete-profile");

    require_once("App".DIRECTORY_SEPARATOR."handleDelete.php");

    handleDelete($userId);

    return;
}

elseif (str_starts_with($path, "/manage-user-role/"))
{
    if (!isLoggedIn() || $_SESSION["role"] !== "admin") return redirectWithMessage("/", "info", "Invalid Request.");
    
    view("manageRole");

    return;
}

elseif ($path == "/assign-role")
{
    if (!isLoggedIn() || $_SESSION["role"] !== "admin") return redirectWithMessage("/", "info", "Invalid Request.");

    require_once("App".DIRECTORY_SEPARATOR."assignRole.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") assignRole();

    return;
}

elseif (str_starts_with($path, "/role/remove/"))
{
    if (!isLoggedIn() || $_SESSION["role"] !== "admin") return redirectWithMessage("/", "info", "Invalid Request.");

    $pathParams = explode("/role/remove/", $path);

    $userId = end($pathParams);

    require_once("App".DIRECTORY_SEPARATOR."removeRole.php");

    removeRole($userId);

    return;
}

elseif ($path == "/profile/delete")
{
    if (!isLoggedIn()) return redirectWithMessage("/", "info", "Invalid Request.");

    require_once("App".DIRECTORY_SEPARATOR."deleteProfile.php");

    deleteProfile();

    return;
}

elseif ($path == "/admin-area")
{
    if (!isLoggedIn()) return redirectWithMessage("/", "info", "Invalid Request.");

    if ($_SESSION["role"] !== "admin") return redirectWithMessage("/" . $_SESSION["role"] . "-area", "info", "You are not authorized to access the requested page.");

    view("adminArea");

    return;
}

elseif ($path == "/manager-area")
{
    if (!isLoggedIn()) return redirectWithMessage("/", "info", "Invalid Request.");

    if ($_SESSION["role"] == "user") return redirectWithMessage("/" . $_SESSION["role"] . "-area", "info", "You are not authorized to access the requested page.");

    view("managerArea");

    return;
}

elseif ($path == "/user-area")
{
    if (!isLoggedIn()) return redirectWithMessage("/", "info", "Invalid Request.");

    view("userArea");

    return;
}

view('404');
