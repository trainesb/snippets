<?php
require __DIR__ . "/../vendor/autoload.php";

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
        $root = $site->getRoot();
        header("location: $root/login.php");
        exit;
    } else {
        // We are logged in.
        $user = $_SESSION[Snippets\User::SESSION_NAME];
    }
}
