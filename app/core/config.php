<?php

/*set your website title*/

define('WEBSITE_TITLE', "Zay Shop");

/*set database variables*/

define('DB_TYPE', 'mysql');
define('DB_NAME', 'mvc_ecommerce_2');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

/*protocal type http or https*/
define('PROTOCAL', 'http');

// define Stripe API key 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51OG8HtF26LVJlyTRyc7RB4e4kOCeRW6qge37xNurpJ79lIn6ByEaf4StkcShEDmm0NWXnm73CqcVznRJC4bweh6r00fu2B3oF3');
define('STRIPE_SECRET_KEY', 'sk_test_51OG8HtF26LVJlyTRYZL7TOFnFqTKfdyO9aK70rIoBE8apPg4o6kxfGPSvaTEzzNoC7pvSxtGIUQIcLnca8dAqY1O00DKUEfAfT');



/*root and asset paths*/

$path = str_replace("\\", "/", PROTOCAL . "://" . $_SERVER['SERVER_NAME'] . __DIR__  . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);

define('ROOT', str_replace("app/core", "public", $path));
define('MAIL', str_replace("app/core", "", $path));
define('ASSETS', str_replace("app/core", "public/assets", $path));

/*set to true to allow error reporting
set to false when you upload online to stop error reporting*/

define('DEBUG', true);

if (DEBUG) {
	ini_set("display_errors", 1);
} else {
	ini_set("display_errors", 0);
}
