<?php

session_start();

require_once "../../../../bootstrap.php";

$target_url = "location: " . route($next ?? "home");

if ($_GET["id"]) {
    $post_id    = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

    // Insertion
    $sql = "UPDATE posts SET is_pinned = 1 WHERE id = ?";
    $values = [$post_id];
    $result = execute($sql, $values);
    // echo "result: "; var_dump($result); echo "<br>";

    if (!$result) {
        $target_url .= "?error=An error occured!";
        header($target_url);
        exit;
    }

    // Retrieval for logging
    $sql = "SELECT * 
            FROM posts
            WHERE 
                id = ?
            LIMIT 1"; 
    $values = [$post_id];
    // echo "values: "; var_dump($values); echo "<br>";

    $post = execute($sql, $values)->fetch();
    // echo "post: "; var_dump($post); echo "<br>";

    logger($post->id, "post", "pinned $post->title");
}

header($target_url);
