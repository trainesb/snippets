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
        <?php
        echo $view->topicTitle();
        echo $view->createDoc();
        echo $view->topicDocs();
        ?>
    </div>

    <?php echo $view->footer(); ?>
</div>
</body>
</html>
