<?php


namespace View;


use Snippets\Site;

class Author extends View {

    protected $site;

    public function __construct(Site $site, $user) {
        $this->site = $site;

        $this->setTitle("Author");

        $this->addLink("./profile.php?id=".$user->getId()."&mode=view", "Profile");
        $this->addLink("post/logout.php", "Log Out");
    }


}
