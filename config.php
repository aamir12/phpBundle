<?php
define("PROJECT_MODE",false); //Development = false/Production = true;
if(PROJECT_MODE){
    error_reporting(0);
}

session_start();
require_once 'lib/Database.php';
require_once 'lib/Url.php';
require_once 'lib/Pagination.php';
require_once 'lib/functions.php';

$basePth = basename($_SERVER['PHP_SELF']);

define('BASE_DIR', dirname(__FILE__));

/************Define URL Constant*****/
if(PROJECT_MODE){
    define("MAIN_URL","http://codexking.com/phpbundle/");
}else{
    define("MAIN_URL","http://localhost/phpbundle/");
}

define("ADMIN_URL",MAIN_URL."admin/");
define("ASSETS",MAIN_URL."assets");
define("PROJECT_NAME","PhpBundle");
define('WEB_EMAIL','info@codexking.com');
/**********end of url************/

// Database configuration
if(PROJECT_MODE){
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'php_bundle');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
}else{
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'php_bundle');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
}
?>