<?php

/**
 * This file contains global settings and things that should be loaded at the
 * top of each file.  If you don't include it, you're gonna have a bad time.
 */
ob_start();

session_start();

header("Access-Control-Allow-Origin: *");

/* if (strtolower($_GET['format']) == 'plain') {
  define("JSON", false);
  header('Content-Type: text/plain');
  } else {
  define("JSON", true);
  header('Content-Type: application/json');
  } */

// Some custom strings so we can copy the whole app
// and make new projects without using Ctrl-H
// Also good for custom branding, but the real reason is I'm lazy AF.
// Sidenote: that's why the commenting is so crap,
// because I gave up after a couple files.  Sucks to be you, but it's just PHP,
// a 12 year old can write it for his Minecraft site if he wants to.
require "appinfo.php";

// Composer
require 'vendor/autoload.php';

// Database settings
// Also inits database and stuff
$database;
try {
    require 'dbsettings.php';
} catch (Exception $ex) {
    header('HTTP/1.1 500 Internal Server Error');
    die('Database error.  Try again later.');
}

// Show errors and stuff?
define("DEBUG", false);

if (!DEBUG) {
    error_reporting(0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

/**
 * Checks if a string or whatever is empty.
 * @param $str The thingy to check
 * @return boolean True if it's empty or whatever.
 */
function is_empty($str) {
    return (!isset($str) || $str == '' || $str == null);
}

function isuserloggedin() {
    if ($_SESSION['loggedin'] == true) {
        return true;
    }
    return false;
}

function usernamefromid($id) {
    global $database;
    return $database->select('users', 'username', ['userid' => $id])[0];
}

function useridexists($id) {
    global $database;
    return $database->has('users', 'username', ['userid' => $id]);
}

function realnamefromid($id) {
    global $database;
    return $database->select('users', 'realname', ['userid' => $id])[0];
}

function userrolefromid($id) {
    global $database;
    return $database->select('users', 'userroles_roleid', ['userid' => $id])[0];
}

/**
 * This function checks if the user has a valid session,
 * and kicks them to the login screen if they don't.
 */
function redirectifnotloggedin() {
    if (!isuserloggedin() && $_GET['action'] != 'login' && $_GET['action'] != 'loggedout') {
        header('Location: /?action=login');
        die();
    }
}

/**
 * http://stackoverflow.com/a/24401462/2534036
 */
function checkIsAValidDate($myDateString) {
    return (bool) strtotime($myDateString);
}
