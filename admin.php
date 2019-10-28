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
    <?php echo $view->nav(); ?>
    <h1 class='center'>Admin</h1>

    <?php
    echo $view->newCatForm();
    echo $view->CategoriesTable();

    echo $view->newTopicForm();
    echo $view->TopicsTable();

    echo $view->footer();
    ?>
</body>
</html>
