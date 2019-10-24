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

    <div class="row-container">
        <div class="left">
            <?php
            echo $view->languageForm();
            echo $view->languagesTable();
            ?>
        </div>
        <div class="right">
            <?php echo $view->snippetForm(); ?>
        </div>
    </div>
    <?php echo $view->footer(); ?>
</body>
</html>
