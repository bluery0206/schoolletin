<?php

const DEBUG = true;


/* =============
DIRECTORY CONFIG
============= */
const DIR_ROOT = __DIR__;
const DIR_PUBLIC = DIR_ROOT . "/public";
const DIR_ASSET = DIR_ROOT . "/assets";

# If you're in development and have multiple projects inside your `htdocs/` or `html/` folders, then
# You can add those sub-directories here. For example: "/commissions/task-manager", else
# If in deployment, where there should only be the project folder or files, leave it empty.
const URL_BASE = "/schooletin";

define("SERVER_NAME", $_SERVER['SERVER_NAME']);
define("URL_ROOT", $_SERVER['REQUEST_SCHEME'] . "://" . SERVER_NAME . URL_BASE);

const URL_PUBLIC = URL_ROOT . "/public";
const URL_ASSET = URL_ROOT . "/assets";


/* =============
DEFAULTS CONFIG
============= */
const UPLOADS_DIR = DIR_ASSET . "/uploads";

$next = $_GET["next"] ?? "home";
$previous = $_GET["next"] ?? "home";
