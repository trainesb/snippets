<?php


namespace View;


use Table\Languages;

class Snippets extends View {

    protected $site;
    private $languages;

    private $snippets;
    private $query;
    private $langId;

    public function __construct($site) {
        $this->site = $site;
        $this->languages = new Languages($site);
        $this->snippets = new \Table\Snippets($site);

        $this->query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

        $this->langId = $this->languages->getId($this->query)['id'];
        $this->setTitle($this->query);
    }

    public function snippetCard($title, $html) {
        $html = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
        $html = str_replace("&amp;hellip;", "&hellip;", $html);

        return <<<HTML
<figure>
    <figcaption>$title</figcaption>
    <pre class="line-numbers">
        <code contenteditable spellcheck="false">
            $html
        </code>
    </pre>
</figure>
HTML;
    }

    public function processSnippets() {
        $snippets = $this->snippets->getById($this->langId);

        $html = "<div class='container'>";

        foreach ($snippets as $snippet) {
            $title = $snippet["title"];
            $description = $snippet["description"];
            $id = $snippet["lang_id"];
            //$code = $snippet["code"];
            $code = base64_decode($snippet["code"]);
            $html .= $this->snippetCard($title, $code);
        }
        $html .= "</div>";
        return $html;
    }

}
