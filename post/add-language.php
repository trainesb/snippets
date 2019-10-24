
$open = true;        // Can be accessed when not logged in
require '../lib/site.inc.php';

$controller = new Controller\AddLanguage($site, $_POST);
echo $controller->getResult();
