<?php


namespace View;

use Table\Languages;
use Table\Snippets;

class Home extends View {

    protected $site;
    private $languages;
    private $snippets;
    private $query;

    public function __construct($site, $user) {
        $this->site = $site;
        $this->languages = new Languages($site);
        $this->snippets = new Snippets($site);

        $this->query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        if ($this->query) {
            $this->setTitle($this->query);
        } else {
            $this->setTitle("Home");
        }

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

        foreach ($this->languages->getAll() as $lang) {
            $html .= "<li><a href='./?" . $lang['lang'] . "'>" . $lang['lang'] . "</a>";
        }

        $html .= "</ul></div>";
        return $html;
    }

    public function snipCard() {
        $lang_id = $this->languages->getId($this->query)['id'];
        $snippets = $this->snippets->getById($lang_id);

        $html = '';

        foreach ($snippets as $snippet) {
            $id = $snippet['id'];
            $lang_id = $snippet['lang_id'];
            $title = $snippet['title'];
            $html .= <<<HTML
<div class="snip-card">
    <h3><a href="./snippet.php?lang_id=$lang_id&id=$id">$title</a></h3>
</div>
HTML;
        }

        return $html;
    }
}
