<?php

session_start();

require_once "../../../bootstrap.php";

$target_url = "location: " . route("home");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize the inputs
    $id             = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $category_id    = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);
    $title          = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $caption        = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_STRING);

    echo "id: "; var_dump($id); echo "<br>";
    echo "category_id: "; var_dump($category_id); echo "<br>";
    echo "title: "; var_dump($title); echo "<br>";
    echo "caption: "; var_dump($caption); echo "<br>";

    // Check if the fields are filled up
    if (empty($category_id) || empty($title) || empty($caption)) {
        $target_url .= "?error=Fields must be filled to continue.";
        header($target_url);
        exit;
    }

    // Check if post already exists
    $sql = "SELECT id 
            FROM posts 
            WHERE 
                title = ? AND 
                caption = ? 
            LIMIT 1"; 
    $values = [$title, $caption];
    $post = execute($sql, $values)->fetch();
    // echo "post: "; var_dump($post); echo "<br>";

    if ($post) {
        $target_url .= "?error=Post already exists!";
        header($target_url);
        exit;
    }

    // Insertion
    $sql = "UPDATE posts SET category_id = ?, title = ?, caption = ? WHERE id = ?";
    $values = [$category_id, $title, $caption, $id];
    $result = execute($sql, $values);

    if (!$result) {
        $target_url .= "?error=An error occured!";
        header($target_url);
        exit;
    }

    // Retrieval for logging
    $sql = "SELECT * 
            FROM posts 
            WHERE 
                title = ? AND 
                caption = ? 
            LIMIT 1"; 
    $values = [$title, $caption];
    $post = execute($sql, $values)->fetch();
    logger($post->id, "post", "edit");
}

header($target_url);
