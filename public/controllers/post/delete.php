<?php

session_start();

require_once "../../../bootstrap.php";

$target_url = "location: " . route("home");

    // Sanitize the inputs
$id             = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

// Check if the fields are filled up
if (empty($id)) {
    header($target_url);
    exit;
}

// Check if post already exists
$sql = "SELECT id 
        FROM posts 
        WHERE 
            id = ?
        LIMIT 1"; 
$values = [$id];
$post = execute($sql, $values)->fetch();
// echo "post: "; var_dump($post); echo "<br>";

if (!$post) {
    $target_url .= "?error=Post doesn't exists!";
    header($target_url);
    exit;
}

// Insertion
$sql = "DELETE FROM posts WHERE id = ?";
$values = [$id];
$result = execute($sql, $values);

if (!$result) {
    $target_url .= "?error=An error occured!";
    header($target_url);
    exit;
}

logger($post->id, "post", "delete ");

header($target_url);
