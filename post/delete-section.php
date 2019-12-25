<?php
require '../lib/site.inc.php';

$controller = new Controller\DeleteSection($site, $_POST);
echo $controller->getResult();
