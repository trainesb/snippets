<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

$controller = new Controller\UpdateSnip($site, $_POST);
echo $controller->getResult();
