<?php


namespace View;


use Snippets\Site;

class Staff extends View {

    protected $site;

    public function __construct(Site $site) {
        $this->site = $site;

        $this->setTitle("Staff");

        $this->addLink("post/logout.php", "Log Out");
    }


}
