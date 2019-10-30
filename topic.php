<?php
$open = true;
require 'lib/site.inc.php';
$view = new View\Topic($site, $user);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="topic">
    <?php echo $view->nav(); ?>

    <div class="topic-head">
        <?php echo $view->topicTitle(); ?>
        <?php echo $view->createDoc(); ?>
    </div>

    <div class="container">
        <div class="column sideNav">
            <?php echo $view->categories(); ?>
        </div>
        <div class="column docs">
            <?php echo $view->topicDocs(); ?>
        </div>
    </div>

    <?php echo $view->footer(); ?>
</div>
</body>
</html>
