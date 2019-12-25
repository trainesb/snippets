<?php
require '../lib/site.inc.php';

$controller = new Controller\UpdateSection($site, $_POST);
echo $controller->getResult();
