<?php
/**
 * Script to execute core functionality from terminal
 *
 * arg1 - field to search against - use empty string to search against all fields
 * arg2 - value to search for
 */

require_once('Classes/Controller.php');
require_once('Classes/Model.php');

$Controller = new Controller();

// get input from cmd line
$field = $argv[1];
$value = $argv[2];

//search values
$results = $Controller->SearchData($field, $value);

//display values
foreach( $results as $r) {
    echo $r['identifier']."\r\n";
}