<?php
require '../lib/site.inc.php';

$controller = new Controller\AddSection($site, $_POST);
echo $controller->getResult();
