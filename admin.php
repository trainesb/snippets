<?php
require 'lib/site.inc.php';
$view = new View\Admin($site);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="admin">
    <?php echo $view->present(); ?>
</body>
</html>
