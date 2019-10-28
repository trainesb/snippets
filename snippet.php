<?php

use View\Snippets;

$open = true;
require 'lib/site.inc.php';
$view = new Snippets($site, $user);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="snippet">
    <?php
    echo $view->nav();
    echo $view->snippetTitle($view->getMode());

    ?>

    <div class="row-container">
        <div class="left">
            <?php echo $view->langLinks(); ?>
        </div>
        <div class="right">
            <?php echo $view->toggleBtn(); ?>
        </div>
    </div>

    <?php echo $view->footer(); ?>
</div>
</body>
</html>
