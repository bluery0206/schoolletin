<?php

session_start();

require_once "../../bootstrap.php";

if ($_SESSION["user"]) {
    logger($_SESSION["user"]->id, "user", "logout");
}

// Destroy session safely
session_unset();
session_destroy();

// Redirect to login
redirect("home");
exit;