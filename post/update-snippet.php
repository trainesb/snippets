<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

$controller = new Controller\UpdateSnippet($site, $_POST);
echo $controller->getResult();
