<?php
$open = true;
require 'lib/site.inc.php';
$view = new View\Doc($site, $user);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="doc">
    <?php
    echo $view->nav();
    echo $view->docTitle($view->getMode());

    ?>

    <?php echo $view->toggleBtn(); ?>

    <?php echo $view->footer(); ?>
</div>
</body>
</html>
