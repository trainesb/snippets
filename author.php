<?php
require 'lib/site.inc.php';
$view = new View\Author($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="author">
    <?php echo $view->nav(); ?>
    <h1 class='center'>Author</h1>

    <?php
    echo $view->footer();
    ?>
</body>
</html>
