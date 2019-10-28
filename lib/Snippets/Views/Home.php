<?php


namespace View;

use Table\Languages;
use Table\Snip;
use Table\Snippets;

class Home extends View {

    protected $site;
    private $languages;
    private $snippets;
    private $snips;
    private $query;

    private $lang_id;

    public function __construct($site, $user) {
        $this->site = $site;
        $this->languages = new Languages($site);
        $this->snippets = new Snippets($site);
        $this->snips = new Snip($site);

        $this->query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        if ($this->query) {
            $this->setTitle($this->query);
        } else {
            $this->setTitle("Home");
        }

        $this->lang_id = $this->languages->getId($this->query)['id'];

        if ($user) {
            if ($user->isStaff()) {
                $this->addLink("./staff.php", "Staff");
            }
            $this->addLink("./logout,php", "Log Out");
        } else {
            $this->addLink("login.php", "Log In");
        }
    }

    public function createSnippet() {
        $lang_id = $this->lang_id;
        return <<<HTML
<button class="create-snippet" name="$lang_id">Create Snippet</button>
HTML;

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
        $lang_id = $this->lang_id;
        $snippets = $this->snippets->getById($lang_id);

        $html = '';

        foreach ($snippets as $snippet) {
            $id = $snippet['id'];
            $lang_id = $snippet['lang_id'];
            $title = $snippet['title'];
            $snips = $this->snips->getBySnippetId($id);
            $html_snapshot = '';

            foreach ($snips as $snip) {
                $snip_id = $snip['id'];
                $text = $snip['text'];
                $tag = $snip['tag'];
                if ($tag === 'pre') {
                    $text = base64_decode($text);
                    $html_snapshot = '<pre id="' . $snip_id . '"><code>' . $text . '</code></pre>';
                    break;
                }
            }

            $html .= <<<HTML
<div class="snip-card">
    <div class="row-container">
        <div class="left-half">
            <h3><a href="./snippet.php?lang_id=$lang_id&id=$id&mode=view">$title</a></h3>
        </div>
        <div class="right-half">
            <button class="delete-snippet" name="$title" id="$id"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </div>    
    </div>
    $html_snapshot
</div>
HTML;
        }

        return $html;
    }
}
