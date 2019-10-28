<?php
require '../lib/site.inc.php';

$controller = new Controller\AddCategory($site, $_POST);
echo $controller->getResult();
