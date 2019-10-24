<?php
require __DIR__ . "/../vendor/autoload.php";

define("LOGIN_COOKIE", "snippets_cookie");

$site = new Snippets\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}

// Start the session system
session_start();
$user = null;
if(isset($_SESSION[Snippets\User::SESSION_NAME])) {
    $user = $_SESSION[Snippets\User::SESSION_NAME];
}

if(!isset($open) || !$open) {
    // This is a page other than the login pages
    if (!isset($_SESSION[Snippets\User::SESSION_NAME])) {


        // We have a valid cookie
        $cookies = new Snippets\Cookies($site);
        $val = $cookies->validate(LOGIN_COOKIE['user'], LOGIN_COOKIE['token']);
        if($val != null) {
            $user = LOGIN_COOKIE['user'];
            // It's valid, we can log in!
            $_SESSION[Snippets\User::SESSION_NAME] = array("user" => $user);
        } else {
            // If not logged in, force to the login page
            $root = $site->getRoot();
            header("location: $root/login.php");
            exit;
        }
    } else {
        // We are logged in.
        $user = $_SESSION[Snippets\User::SESSION_NAME];
    }
}
