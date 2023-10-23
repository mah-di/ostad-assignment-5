<?php

function getPath()
{
    return rtrim($_SERVER['PATH_INFO'], "\n\r\t\v\x00/");
}

function view(string $view)
{
    $_SESSION["view"]               =   $view;

    require_once("Frontend".DIRECTORY_SEPARATOR."template.php");

    unset($_SESSION["view"]);
    unset($_SESSION["info"]);
    unset($_SESSION["success"]);
    unset($_SESSION["error"]);
    unset($_SESSION["message"]);
}

function authView(string $view)
{
    $_SESSION["view"]               =   $view;

    require_once("Frontend".DIRECTORY_SEPARATOR."template.php");

    session_unset();
}

function getDBFilename()
{
    return getcwd() . DIRECTORY_SEPARATOR . "DB/users.json";
}

function save(array $users)
{
    $filename                       =   getDBFilename();

    $content                        =   json_encode($users, JSON_PRETTY_PRINT);

    file_put_contents($filename, $content, LOCK_EX);
}

function getUsers()
{
    $filename                       =   getDBFilename();

    $users                          =   json_decode(file_get_contents($filename, LOCK_EX));

    return $users;
}

function getUser(int $userId): stdClass
{
    $users                          =   getUsers();

    $user                           =   $users[$userId];

    return $user;
}

function emailExists($email)
{
    $users                          =   getUsers();

    foreach ($users as $user) if ($user->email == $email) return true;

    return false;
}

function usernameExists($username)
{
    $users                          =   getUsers();

    foreach ($users as $user) if ($user->username == $username) return true;

    return false;
}

function createUser(): stdClass
{
    $user                           =   new stdClass();
    
    $user->username                 =   $_POST["username"];
    $user->email                    =   $_POST["email"];
    $user->password                 =   hash("sha256", $_POST["password"]);
    $user->role                     =   "user";

    return $user;
}

function redirect(string $url, int $code = 0)
{
    return header("Location: {$url}");
}

function redirectWithMessage(string $url, string $type, string $message)
{
    if ($type == "info") $_SESSION["info"]                  =   true;
    if ($type == "success") $_SESSION["success"]            =   true;
    if ($type == "error") $_SESSION["error"]                =   true;

    $_SESSION["message"]            =   $message;

    return header("Location: {$url}");
}

function validationError(string $redirect, string $msg, string $username, string $email)
{
    $_SESSION["username"]           =   $username;
    $_SESSION["email"]              =   $email;
    
    return redirectWithMessage($redirect, "error", $msg);
}

function register()
{
    $newUser                        =   createUser();

    $users                          =   getUsers();

    $users[]                        =   $newUser;

    save($users);

    end($users);

    $userId                         =   key($users);

    $newUser->userId                =   $userId;

    return $newUser;
}

function userExists(string $username, string $password)
{
    $users                          =   getUsers();

    foreach ($users as $userId =>$user)
    {
        if ($user->username == $username && $user->password == hash("sha256", $password))
        {
            $user->userId           =   $userId;
    
            return $user;
        }
    }

    return false;
}

function login(stdClass $user)
{
    $_SESSION["isLoggedIn"]         =   true;
    $_SESSION["userId"]             =   $user->userId;
    $_SESSION["username"]           =   $user->username;
    $_SESSION["email"]              =   $user->email;
    $_SESSION["role"]               =   $user->role;
}

function isLoggedIn(): bool
{
    return isset($_SESSION["isLoggedIn"]);
}

function updateUser($username, $email)
{
    $userId                         =   $_SESSION["userId"];

    $users                          =   getUsers();

    $users[$userId]->username       =   $username;
    $users[$userId]->email          =   $email;

    save($users);
}
