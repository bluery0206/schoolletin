<?php

session_start();

require_once "../../bootstrap.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_url = "Location: " . route("home");

    // Retrieve username and password from form
    $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Proceed to the validation if the user has entered
    // both the username and password
    if ($username && $password) {
        // Query to get the user
        $sql    = "SELECT * FROM users WHERE username = ?";
        $values = [$username];
        $user   = execute($sql, $values)->fetch();

        // Proceed to the validation if the user with the username exists and
        // if the password if correct
        if (isset($user->password) && password_verify($password, $user->password)) {
            logger($user->id, "user", "login");

            $_SESSION["user"] = $user;
            header("location: index.php");
        } else {
            // Says the same thing regardless if the
            // user doesnt exists or the password is wrong for security reasons
            $target_url .= "?error=Wrong username and password.";
        }
    } else {
        $$target_url .= "?error=Username and password cannot be empty.";
    }

    header($target_url);
}