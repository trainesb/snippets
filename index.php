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
    <div class="home">
        <?php echo $view->nav(); ?>

        <div class="home-header">
            <h1 class='center'><?php echo $view->getTitle(); ?></h1>
        </div>

        <?php echo $view->categories(); ?>

        <?php echo $view->footer(); ?>
    </div>
</body>
</html>
