<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

function logout()
{
    session_unset();

    session_destroy();

    return redirect("/");
}