<?php
$open = true;
require 'lib/site.inc.php';
$view = new View\Category($site, $user);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="category">
    <?php
    echo $view->nav();
    echo $view->present();
    echo $view->footer();
    ?>
</div>
</body>
</html>
