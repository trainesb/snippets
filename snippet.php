<?php

use View\Snippets;

$open = true;
require 'lib/site.inc.php';
$view = new Snippets($site);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="snippet">
    <?php echo $view->nav(); ?>



    <?php echo $view->toggleBtn(); ?>


    <?php echo $view->footer(); ?>
</div>
</body>
</html>
