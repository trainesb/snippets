<?php
require 'lib/site.inc.php';
$view = new View\Profile($site, $user);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="profile">
    <?php echo $view->nav(); ?>

    <div class="profile-header">
        <h1 class='center'><?php echo $view->getTitle(); ?></h1>
    </div>

    <?php echo $view->userCard(); ?>


    <?php echo $view->footer(); ?>
</div>
</body>
</html>
