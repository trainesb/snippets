<?php
require '../lib/site.inc.php';

$controller = new Controller\AddTopic($site, $_POST);
echo $controller->getResult();
