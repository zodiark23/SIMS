<?php


/**
 * Default page to be used if no routing is found
 */
define("DEFAULT_ROUTE_PAGE", "default");

$actual_link = "http://".$_SERVER["HTTP_HOST"]."/sims";

/**
 * Default base url used by whole application
 * TODO : dynamic fetching of base url
 */
define("BASE_URL", $actual_link);

/**
 * Database Configurations
 */
define('DB_HOST','localhost:3306');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','sims');



/**
 * 
 * System Configuration
 */

 define("DEFAULT_TEACHER_ROLE_ID", 2);
 define("DEFAULT_STUDENT_ROLE_ID", 3);
