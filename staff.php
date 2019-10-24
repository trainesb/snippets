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

    <?php echo $view->present(); ?>

    <div>
        <ul>
            <li><a href="./add-language.php">Add Language</a></li>
            <li><a href="./add-snippet.php">Add Snippet</a></li>
        </ul>
    </div>

    <?php echo $view->footer(); ?>
</body>
</html>
