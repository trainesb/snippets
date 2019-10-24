<?php


namespace View;



use Table\Snip;

class Snippets extends View {

    protected $site;
    private $snips;
    private $snippet_id;
    private $snippets;
    private $title;

    public function __construct($site) {
        $this->site = $site;
        $this->snips = new Snip($site);
        $this->snippets = new \Table\Snippets($site);
        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
        $this->snippet_id = $id;
        $this->title = $this->snippets->getTitleBySnippetId($this->snippet_id);
        $this->setTitle($this->title);
    }

    public function snippetCard() {
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

        return $title . $html_snapshot . $html;
    }

}
