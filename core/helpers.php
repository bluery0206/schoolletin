<?php


/**
 * Redirect the client to a public PHP page.
 *
 * Similar to Django's `redirect()`, but instead of a route name
 * it expects the base filename (without `.php`) of a public page.
 *
 * @param string $url
 *     The base filename of the target page (e.g. `"dashboard"`).
 * @return void
 */
function redirect(string $url) {
    header("LOCATION: " . route($url));
}


/**
 * Resolve a public URL from a page name.
 *
 * Works like Django's `reverse()` but without named routes.
 * It checks that the corresponding file exists in the public
 * directory before returning the full URL.
 *
 * @param string $name
 *     Base filename (without `.php`) located in DIR_PUBLIC.
 * @return string
 *     Full public URL to the PHP file.
 */
function route(string $name): string {
    $file_path = DIR_PUBLIC . "/$name.php";
    
    if (!file_exists($file_path)) {
        throw new Exception("Route cannot be found. Route: $file_path");
    }

    return URL_PUBLIC . "/$name.php";
}


/**
 * Get the correct path or URL to a static asset.
 *
 * Returns a public URL for typical assets (CSS, JS, images, etc.).
 * If the requested file is a PHP script, it returns the absolute
 * server path instead—handy when you need to `include` or `require`
 * that PHP file instead of linking to it.
 *
 * @param string $relative_path
 *     Path to the asset relative to the assets directory
 *     (e.g. `"css/app.css"` or `"partials/header.php"`).
 *
 * @return string
 *     - For non-PHP files: Full public URL to the asset.
 *     - For `.php` files: Absolute filesystem path.
 */
function asset(string $relative_path): string {
    $extension = pathinfo($relative_path, PATHINFO_EXTENSION);
    // echo "EXTENSION: $extension<BR>";

    $path_absolute =  DIR_ASSET . "/$relative_path";
    $path_url =  URL_ASSET . "/$relative_path";
    // echo "ABS_PATH: {$path_absolute}<BR>";
    // echo "URL_PATH: {$path_url}<BR><BR>";

    if (!file_exists($path_absolute)) {
        throw new Exception($path_absolute);
    }

    echo "URL_PATH: " . $extension == "php" . "<BR><BR>";
    return $extension == "php" ? $path_absolute : $path_url;
}


/**
 * Checks if the given view name ("../fileName") is the same as the given view ("../fileName.php").
 * If they are the same, return the $return_on_true value, else return an empty string.
 * 
 * Useful for setting active class for navigation links.
 * @param string|array $view
 * @param string $return_on_true
 * @return string
 */
function is_view_active(array|string $view, string $return_on_true = "active"): string {
    $is_active = NULL;
    $type = gettype($view);
    // echo "is_active: "; var_dump($is_active); echo "<br>";
    // echo "type: "; var_dump($type); echo "<br>";

    try {
        if ($type == "string") {
            $route = route($view);
            $view_name = pathinfo($route, PATHINFO_FILENAME);
            $current_view_name = pathinfo($_SERVER["PHP_SELF"], PATHINFO_FILENAME);
            $is_active = $current_view_name == $view_name ;
        }
        elseif ($type == "array") {
            foreach ($view as $v) {
                $route = route($v);
                $view_name = pathinfo($route, PATHINFO_FILENAME);
                $current_view_name = pathinfo($_SERVER["PHP_SELF"], PATHINFO_FILENAME);

                if ($current_view_name == $view_name) {
                    $is_active = TRUE;
                    break;
                }
            }
        } else {
            throw new Exception();
        }
    } catch (Exception $e) {
        return "";
    }

    return $is_active ? $return_on_true : "" ;
}


/**
 * Returns `True` if the `$_SESSION["user"]` or the given `$user` is logged-in.
 * @param $user
 * @return bool|null
 */
function is_authorized($user = null) {
    return isset($user) ? $user == $_SESSION["user"]: isset($_SESSION["user"]);
}


function logger($category_id, $category, $action) {
    $sql    = "INSERT INTO logs (category_id, category, action) 
                VALUES (?, ?, ?);";
    $values = [$category_id, $category, $action];
    execute($sql, $values);
}


function current_url() {
    $current_url = array_reverse(explode("public/", $_SERVER['REQUEST_URI']))[0];
    // echo "current_url: "; var_dump($current_url); echo "<br>";
    
    $current_url = explode(".php", $current_url)[0];
    // echo "current_url: "; var_dump($current_url); echo "<br>";

    // $current_url = base64_encode($current_url);
    // echo "current_url: "; var_dump($current_url); echo "<br>";

    return $current_url;
}