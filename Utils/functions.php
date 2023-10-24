<?php

function getPath(): string
{
    return rtrim($_SERVER['PATH_INFO'], "\n\r\t\v\x00/");
}

function view(string $view): void
{
    $_SESSION["view"]               =   $view;

    require_once("Frontend".DIRECTORY_SEPARATOR."template.php");

    unset($_SESSION["info"]);
    unset($_SESSION["success"]);
    unset($_SESSION["error"]);
    unset($_SESSION["message"]);
}

function authView(string $view): void
{
    $_SESSION["view"]               =   $view;

    require_once("Frontend".DIRECTORY_SEPARATOR."template.php");

    session_unset();
}

function getDBFilename(): string
{
    return "DB" . DIRECTORY_SEPARATOR . "users.json";
}

function save(array $users): void
{
    $filename                       =   getDBFilename();

    $content                        =   json_encode($users, JSON_PRETTY_PRINT);

    file_put_contents($filename, $content, LOCK_EX);
}

function getUsers(): array
{
    $filename                       =   getDBFilename();

    $users                          =   json_decode(file_get_contents($filename, LOCK_EX));

    return $users;
}

function getUser($userId): ?stdClass
{
    $users                          =   getUsers();

    $user                           =   array_key_exists($userId, $users) ? $users[$userId] : null;

    return $user;
}

function emailExists(string $email): bool
{
    $users                          =   getUsers();

    foreach ($users as $user) if ($user->email == $email) return true;

    return false;
}

function usernameExists(string $username): bool
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

function redirect(string $url)
{
    return header("Location: {$url}");
}

function setMessage(string $type, string $message): void
{
    $_SESSION[$type]                =   true;

    if (isset($_SESSION["message"])) $_SESSION["message"][] =   $message;

    else $_SESSION["message"]                               =   [$message];

}

function redirectWithMessage(string $url, string $type, string $message)
{
    setMessage($type, $message);

    return redirect($url);
}

function checkValidation(string $username, string $email, string $password, string $passwordConfirm): bool
{
    $validData                              =   true;

    if ($username == "" || $email == "" || $password == "" || $passwordConfirm == "")
    {
        $validData                          =   false;

        setMessage("error", "All fields are required.");
    }

    if (strlen($password) < 6)
    {
        $validData                          =   false;

        setMessage("error", "Password must contain 6 or more characters.");
    }

    if ($password !== $passwordConfirm)
    {
        $validData                          =   false;

        setMessage("error", "Passwords doesn't match.");
    }

    if (usernameExists($username))
    {
        $validData                          =   false;

        setMessage("error", "The username is taken.");
    }

    if (emailExists($email))
    {
        $validData                          =   false;

        setMessage("error", "The email is taken.");
    }

    if (!$validData)
    {
        $_SESSION["requestedUsername"]      =   $username;
        $_SESSION["requestedEmail"]         =   $email;
    }

    return $validData;
}

function register(): stdClass
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

function userExists(string $username, string $password): stdClass | false
{
    $users                          =   getUsers();

    foreach ($users as $userId => $user)
    {
        if ($user->username == $username && $user->password == hash("sha256", $password))
        {
            $user->userId           =   $userId;
    
            return $user;
        }
    }

    return false;
}

function login(stdClass $user): void
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
