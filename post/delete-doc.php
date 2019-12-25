<?php
require '../lib/site.inc.php';

$controller = new Controller\DeleteDoc($site, $_POST);
echo $controller->getResult();
