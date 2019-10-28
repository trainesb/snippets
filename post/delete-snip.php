<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

$controller = new Controller\DeleteSnip($site, $_POST);
echo $controller->getResult();
