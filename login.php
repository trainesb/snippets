<?php
$open = true;
require 'lib/site.inc.php';

$view = new View\Login($site, $_COOKIE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="login">
    <?php
    echo $view->nav();
    echo $view->presentForm();
    echo $view->footer();
    ?>
</div>

</body>
</html>
