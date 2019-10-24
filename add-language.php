<?php
require 'lib/site.inc.php';
$view = new View\AddLanguage($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="staff">
    <?php echo $view->nav(); ?>

    <?php echo $view->present(); ?>


    <?php echo $view->footer(); ?>
</body>
</html>
