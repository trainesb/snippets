<?php
require '../lib/site.inc.php';

$controller = new Controller\UpdateDoc($site, $_POST);
echo $controller->getResult();
