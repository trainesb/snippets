<?php

return function (Snippets\Site $site) {

    // Set the time zone
    date_default_timezone_set('America/Detroit');
    $site->setEmail('trainesben68@gmail.com');
    $site->setRoot('/snippets');
    $site->dbConfigure('mysql:host=localhost;dbname=snippets','root','','');
};
