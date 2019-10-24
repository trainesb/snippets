<?php


namespace View;



use Table\Snip;

class Snippets extends View {

    protected $site;
    private $snips;
    private $snippet_id;
    private $snippets;
    private $title;
    private $mode;
    private $lang_id;

    public function __construct($site) {
        $this->site = $site;
        $this->snips = new Snip($site);
        $this->snippets = new \Table\Snippets($site);
        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
        $this->snippet_id = $id;
        $this->mode = $mode;
        $this->lang_id = $lang_id;
        $this->title = $this->snippets->getTitleBySnippetId($this->snippet_id);
        $this->setTitle($this->title);
    }

    public function toggleBtn() {
        if($this->mode === 'view') {
            return $this->snippetCard();
        } elseif ($this->mode === 'edit') {
            return $this->editSnippet();
        }
    }

    public function snippetCard() {
        $btn = '<div class="container"><p class="edit-snippet"><a href="./snippet.php?lang_id='.$this->lang_id.'&id='.$this->snippet_id.'&mode=edit">Edit Snippet</a></p>';
        $title = '<h1 class="center snippet-title">'.$this->title.'</h1>';
        $html = '';
        $html_snapshot = '';
        $snips = $this->snips->getBySnippetId($this->snippet_id);

        foreach ($snips as $snip) {
            $snip_id = $snip['id'];
            $text = $snip['text'];
            $tag = $snip['tag'];
            if($tag === 'pre') {
                $text = base64_decode($text);
                $html_snapshot = '<pre id="'.$snip_id.'"><code>'.$text.'</code></pre>';

                $code = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                $code = str_replace("&amp;hellip;", "&hellip;", $code);
                $html .= '<pre id="'.$snip_id.'"><code>'.$code.'</code></pre>';

            } else {
                $html .= '<p id="'.$snip_id.'">'.$text.'</p>';
            }
        }

        return $btn . $title . $html_snapshot . $html . "</div>";
    }

    public function editSnippet() {
        $btn = '<p class="done-edit"><a href="./snippet.php?lang_id='.$this->lang_id.'&id='.$this->snippet_id.'&mode=view">Finish Editing</a></p>';
        $title = '<h1 class="center snippet-title" contenteditable="true">'.$this->title.'</h1><div class="container">';
        $html = '';
        $html_snapshot = '';
        $snips = $this->snips->getBySnippetId($this->snippet_id);

        foreach ($snips as $snip) {
            $snip_id = $snip['id'];
            $text = $snip['text'];
            $tag = $snip['tag'];
            if($tag === 'pre') {
                $text = base64_decode($text);
                $html_snapshot = '<pre id="'.$snip_id.'"><code>'.$text.'</code></pre>';

                $code = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                $code = str_replace("&amp;hellip;", "&hellip;", $code);
                $html .= '<div class="code"><pre id="'.$snip_id.'"><code contenteditable="true">'.$code.'</code></pre></div>';

            } else {
                $html .= '<div class="description" contenteditable="true"><p id="'.$snip_id.'">'.$text.'</p></div>';
            }
        }

        $html .= <<<HTML
</div><div class="center">
    <button value="add-textarea" name="add-textarea" class="add-textarea">Add Textarea</button>
    <button value="add-code" name="add-code" class="add-code">Add Code Snippet</button>
</div>
HTML;
        return $btn . $title . $html_snapshot . $html;
    }

}
