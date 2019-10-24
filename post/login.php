<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

$controller = new Controller\Login($site, $_SESSION, $_POST);
echo $controller->getResult();
