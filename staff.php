<?php
require 'lib/site.inc.php';
$view = new View\Staff($site);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="staff">
    <?php echo $view->nav(); ?>
    <h1 class='center'>Staff</h1>

    <?php
    echo $view->footer();
    ?>
</body>
</html>
