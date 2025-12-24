<?php

session_start();

require_once "../../../bootstrap.php";

$target_url = "location: " . route("category/index");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category_id    = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);
    $name           = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_STRING);
    $description    = filter_input(INPUT_POST, 'category_description', FILTER_SANITIZE_STRING);

    echo "category_id: "; var_dump($category_id); echo "<br>";
    echo "name: "; var_dump($name); echo "<br>";
    echo "description: "; var_dump($description); echo "<br>";

    // Insertion
    $sql = "UPDATE categories 
            SET 
                name = ?,
                description = ?
            WHERE id = ?";
    $values = [$name, $description, $category_id];
    $result = execute($sql, $values);
    // echo "result: "; var_dump($result); echo "<br>";

    if (!$result) {
        $target_url .= "?error=An error occured!";
        header($target_url);
        exit;
    }

    // Retrieval for logging
    $sql = "SELECT * 
            FROM categories
            WHERE 
                id = ?
            LIMIT 1"; 
    $values = [$category_id];
    // echo "values: "; var_dump($values); echo "<br>";

    $category = execute($sql, $values)->fetch();
    // echo "category: "; var_dump($category); echo "<br>";

    logger($category->id, "categories", "edit $category->name");
}

header($target_url);
