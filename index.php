<?php

use View\Snippets;

$open = true;
require 'lib/site.inc.php';
$view = new View\Home($site, $user);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
    <div class="main">
        <?php echo $view->nav(); ?>

        <h1 class='center'><?php echo $view->getTitle(); ?></h1>

        <div class="row-container">
            <div class="left">
                <?php echo $view->langLinks(); ?>
            </div>
            <div class="right">
                <?php echo $view->snipCard(); ?>
            </div>
        </div>

        <?php echo $view->footer(); ?>
    </div>
</body>
</html>