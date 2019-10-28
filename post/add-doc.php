<?php
require '../lib/site.inc.php';

$controller = new Controller\AddDoc($site, $_POST);
echo $controller->getResult();
