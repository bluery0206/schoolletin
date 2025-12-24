<?php

session_start();

require_once "../../../bootstrap.php";

$target_url = "location: " . route("category/index");

if (isset($_GET['id'])) {
    $category_id    = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

    // Retrieval for logging
    $sql = "SELECT * 
            FROM categories
            WHERE 
                id = ?
            LIMIT 1"; 
    $values = [$category_id];

    $category = execute($sql, $values)->fetch();
    echo "category: "; var_dump($category); echo "<br>";
    
    // echo "category: "; v
    // Insertion
    $sql = "DELETE FROM categories 
            WHERE id = ?";
    $values = [$category_id];
    $result = execute($sql, $values);
    // echo "result: "; var_dump($result); echo "<br>";

    if (!$result) {
        $target_url .= "?error=An error occured!";
        header($target_url);
        exit;
    }

    logger($category->id, "categories", "edit $category->name");
}

header($target_url);
