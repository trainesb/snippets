<?php


namespace View;

use Table\Languages;
use Table\Snippets;

class Home extends View {

    protected $site;
    private $languages;
    private $query;

    public function __construct($site, $user) {
        $this->site = $site;
        $this->languages = new Languages($site);

        $this->query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        if ($this->query) {
            $this->setTitle($this->query);
        } else {
            $this->setTitle("Home");
        }

        $this->languages = $this->languages->getAll();

        if ($user) {
            if ($user->isStaff()) {
                $this->addLink("./staff.php", "Staff");
            }
            $this->addLink("./logout,php", "Log Out");
        } else {
            $this->addLink("login.php", "Log In");
        }
    }

    public function langLinks() {
        $html = "<div><ul>";

        foreach ($this->languages as $lang) {
            $html .= "<li><a href='./?" . $lang['lang'] . "'>" . $lang['lang'] . "</a>";
        }

        $html .= "</ul></div>";
        return $html;
    }


}
