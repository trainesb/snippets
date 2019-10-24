<?php
require 'lib/site.inc.php';
$view = new View\Snippets($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="snippets">
    <?php
    echo $view->nav();
    echo $view->present();
    echo $view->footer();
    ?>
</body>
</html>
