<?php


namespace View;



use Table\Languages;
use Table\Snip;

class Snippets extends View {

    protected $site;
    private $snips;
    private $snippet_id;
    private $snippets;
    private $title;
    private $mode;
    private $lang_id;
    private $languages;

    public function __construct($site, $user) {
        $this->site = $site;
        $this->snips = new Snip($site);
        $this->snippets = new \Table\Snippets($site);
        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
        $this->snippet_id = $id;
        $this->mode = $mode;
        $this->lang_id = $lang_id;
        $this->languages = new Languages($site);
        $this->title = $this->snippets->getTitleBySnippetId($this->snippet_id);
        $this->setTitle($this->title);

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

    public function getMode() {
        return $this->mode;
    }

    public function toggleBtn() {
        if($this->mode === 'view') {
            return $this->snippetCard();
        } elseif ($this->mode === 'edit') {
            return $this->editSnippet();
        }
    }

    public function language() {
        $lang = $this->languages->getNameById($this->lang_id)["lang"];
        return "<h2 class='lang-name'>".$lang."</h2>";
    }

    public function snippetTitle($mode) {
        $lang = $this->language();
        if($mode == 'edit') {
            return <<<HTML
<div class="row-container">
    <div class="left-half">
        <h3>$lang</h3>
    </div>
    <div class="right-half">
        <p class="done-edit"><a href="./snippet.php?lang_id=$this->lang_id&id=$this->snippet_id&mode=view">Finish Editing</a></p>
    </div>
</div>

HTML;
        }
        return <<<HTML
<div class="row-container">
    <div class="left-half">
        <h3>$lang</h3>
    </div>
    <div class="right-half">
        <p class="edit-snippet"><a href="./snippet.php?lang_id=$this->lang_id&id=$this->snippet_id&mode=edit">Edit Snippet</a></p>
    </div>
</div>
<h1 class="center snippet-title">$this->title</h1>
HTML;
    }

    public function snippetCard() {

        $snips = $this->snips->getBySnippetId($this->snippet_id);



        $html_snapshot = true;
        $snapshot = '';
        $html = '';
        foreach ($snips as $snip) {
            $snip_id = $snip['id'];
            $text = $snip['text'];
            $tag = $snip['tag'];
            if($tag === 'pre') {
                $text = base64_decode($text);
                if($html_snapshot) {
                    $snapshot = '<pre id="' . $snip_id . '"><code>' . $text . '</code></pre>';
                    $html_snapshot = false;
                }
                $code = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                $code = str_replace("&amp;hellip;", "&hellip;", $code);
                $html .= '<pre id="'.$snip_id.'"><code>'.$code.'</code></pre>';

            } else {
                $html .= '<p id="'.$snip_id.'">'.$text.'</p>';
            }
        }

        return $snapshot . $html;
    }

    public function editSnippet() {
        $snips = $this->snips->getBySnippetId($this->snippet_id);

        $title = <<<HTML
<form class="edit-snippet" id="edit-snippet">
    <p><input type="text" id="$this->snippet_id" class="title" name="title" value="$this->title"></p>
HTML;

        $html_snapshot = true;
        $snapshot = '';
        $html = '';
        foreach ($snips as $snip) {
            $snip_id = $snip['id'];
            $text = $snip['text'];
            $tag = $snip['tag'];
            if($tag === 'pre') {
                $text = base64_decode($text);
                if($html_snapshot) {
                    $snapshot = '<pre id="' . $snip_id . '"><code>' . $text . '</code></pre>';
                    $html_snapshot = false;
                }
                $code = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                $code = str_replace("&amp;hellip;", "&hellip;", $code);
                $html .= '<textarea class="snip" name="code" id="'.$snip_id.'">'.$code.'</textarea>';

            } else {
                $html .= '<textarea class="snip" name="description" id="'.$snip_id.'">'.$text.'</textarea>';
            }

            $html .= '<button class="delete-snip" id="'.$snip_id.'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
        }

        $html .= <<<HTML
    <button value="$this->snippet_id" name="textarea" class="add-snip">Add Textarea</button>
    <button value="$this->snippet_id" name="pre" class="add-snip">Add Code Snippet</button>
</form>
HTML;
        return $title . $snapshot . $html;
    }

}
