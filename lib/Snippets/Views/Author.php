<?php


namespace View;


use Snippets\Site;

class Author extends View {

    protected $site;

    public function __construct(Site $site) {
        $this->site = $site;

        $this->setTitle("Author");

        $this->addLink("./profile.php", "Profile");
        $this->addLink("post/logout.php", "Log Out");
    }


}
