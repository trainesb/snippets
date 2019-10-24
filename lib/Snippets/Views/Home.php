<?php


namespace View;

use Table\Languages;

class Home extends View {

    protected $site;
    private $languages;

    public function __construct($site, $user) {
        $this->site = $site;
        $this->languages = new Languages($site);
        $this->languages = $this->languages->getAll();

        $this->setTitle("Home");

        if($user) {
            if($user->isStaff()) {
                $this->addLink("./staff.php", "Staff");
            }
            $this->addLink("./profile.php", "Profile");
            $this->addLink("./logout,php", "Log Out");
        } else {
            $this->addLink("login.php", "Log In");
        }
    }

    public function present() {
        echo "<h1 class='center'>Home</h1>";

        echo $this->langLinks();
    }

    public function langLinks() {
        $html = "<div><ul>";

        foreach ($this->languages as $lang) {
            $html .= "<li><a href='snippets.php?".$lang['lang']."'>".$lang['lang']."</a>";
        }

        $html .= "</ul></div>";
        return $html;
    }
}
