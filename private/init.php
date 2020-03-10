<?php
ob_start(); //output buffering is turned on
session_start(); // turn on sessions

// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("SHARED_PATH", PRIVATE_PATH . '/shared'); //mainly for page components
define("CORE_PATH", PROJECT_PATH . '/core');
define("PUBLIC_PATH", PROJECT_PATH . '/public'); //web_root
define("API_PATH", PROJECT_PATH . '/api');

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", ''); this is on a production machine whatever
//the domain name is, it is not nested anything deeper
// or use this that
// * can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 11;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root); // yourdomain.com



require_once('helper_functions.php');
require_once('db_conn.php');
//   require_once('query_functions.php');
//   require_once('validation_functions.php');
//   require_once('auth_functions.php'); //user login auth, NOT INCLUDED

$db = db_connect();
$errors = [];

// individually
require_once('classes/Product.class.php');
require_once('classes/Customer.class.php');
require_once('classes/Wishlist.class.php');
require_once('classes/WishProduct.class.php');
require_once('classes/ParseCSV.class.php');

// -> All classes in directory
foreach (glob('classes/*.class.php') as $file) {
    require_once($file);
}

// autoload class definitions
// function my_autoload($class)
// {
//     if (preg_match('/\A\w+\Z/', $class)) {
//         include('./classes/' . $class . '.class.php');
//     }
// }
// spl_autoload_register('my_autoload');
