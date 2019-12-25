<?php
require '../lib/site.inc.php';

$controller = new Controller\AddDoc($site, $user ,$_POST);
echo $controller->getResult();
