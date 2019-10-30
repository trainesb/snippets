<?php


namespace View;

use Table\Sections;
use Table\Users;

class Doc extends View {

    protected $site;

    private $doc;
    private $sections;

    //Document Variables
    private $doc_id;
    private $topic_id;
    private $author;
    private $section_view;
    private $title;
    private $updated;

    private $topic;
    private $cat;
    private $mode;

    public function __construct($site, $user) {
        $this->site = $site;
        $this->doc = new \Table\Doc($site);
        $this->sections = new Sections($site);

        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
        $this->topic = $topic;
        $this->mode = $mode;
        $this->doc_id = $id;
        $this->cat = $cat;

        $this->sections->getByDocId($this->doc_id);

        $doc = $this->doc->getById($this->doc_id);
        $this->topic_id = $doc["topic_id"];
        $this->author = $doc["author"];
        $this->section_view = $doc["section_view"];
        $this->title = $doc["title"];
        $this->updated = date("d-m-Y", strtotime($doc["updated"]));

        $users = new Users($this->site);
        $user = $users->get($this->author);
        $this->author = $user->getName();

        $this->setTitle($this->title);

        if ($user) {
            if($user->isAdmin()) {
                $this->addLink("./admin.php", "Admin");
            }
            if ($user->isStaff()) {
                $this->addLink("./staff.php", "Staff");
            }
            $this->addLink("./logout,php", "Log Out");
        } else {
            $this->addLink("login.php", "Log In");
        }
    }

    public function toggleBtn() {
        if($this->mode === 'view') {
            return $this->viewDoc();
        } elseif ($this->mode === 'edit') {
            return $this->editDoc();
        }
    }

    public function docHeader() {
        $mode = $this->mode;
        if($mode == 'edit') {
            return <<<HTML
<div class="left-half">
    <p><a href="./topic.php?cat=$this->cat&topic=$this->topic">$this->cat - $this->topic</a></p>
</div>
<div class="right-half">
    <p class="done-edit"><a href="./doc.php?cat=$this->cat&topic=$this->topic&id=$this->doc_id&mode=view">Finish Editing</a></p>
</div>
HTML;
        }
        return <<<HTML
<div class="left-half">
    <p><a href="./topic.php?cat=$this->cat&topic=$this->topic">$this->cat - $this->topic</a></p>
</div>
<div class="right-half">
    <p class="edit-snippet"><a href="./doc.php?cat=$this->cat&topic=$this->topic&id=$this->doc_id&mode=edit">Edit Snippet</a></p>
</div>
<ul class="doc-info">
   <li>Doc: #$this->doc_id</li>
   <li>Author: $this->author</li>
   <li>Updated: $this->updated</li> 
</ul>

<h1 class="center snippet-title">$this->title</h1>
HTML;
    }

    public function doc(){

        foreach ($this->sections as $section) {

        }

    }

    public function viewDoc() {

        $sections = $this->sections->getByDocId($this->doc_id);

        $html_snapshot = true;
        $snapshot = '';
        $html = '';
        foreach ($sections as $section) {
            $section_id = $section['id'];
            $text = $section['text'];
            $tag = $section['tag'];
            if($tag === 'pre') {
                $text = base64_decode($text);
                if($html_snapshot) {
                    $snapshot = '<pre id="' . $section_id . '"><code>' . $text . '</code></pre>';
                    $html_snapshot = false;
                }
                $code = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                $code = str_replace("&amp;hellip;", "&hellip;", $code);
                $html .= '<pre id="'.$section_id.'"><code>'.$code.'</code></pre>';

            } else {
                $html .= '<p id="'.$section_id.'">'.$text.'</p>';
            }
        }

        return $snapshot . $html;
    }

    public function editDoc() {
        $sections = $this->sections->getByDocId($this->doc_id);

        $title = <<<HTML
<form class="edit-doc" id="edit-doc">
    <p><input type="text" id="$this->doc_id" class="title" name="title" value="$this->title"></p>
    <p><input type="text" class="doc-tag" name="doc-tag" placeholder="#tag;"></p>
HTML;

        $html = '';
        foreach ($sections as $section) {
            $section_id = $section['id'];
            $text = $section['text'];
            $tag = $section['tag'];
            if($tag === 'pre') {
                $text = base64_decode($text);
                $code = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                $code = str_replace("&amp;hellip;", "&hellip;", $code);
                $html .= <<<HTML
<div class="doc-textarea code">
    <textarea class="section" name="code" id="$section_id">$code</textarea>
    <button class="delete-section" id="$section_id"><i class="fa fa-trash" aria-hidden="true"></i></button>
</div>
HTML;
            } else {
                $html .= <<<HTML
<div class="doc-textarea">
    <textarea class="section" name="description" id="$section_id">$text</textarea>
    <button class="delete-section" id="$section_id"><i class="fa fa-trash" aria-hidden="true"></i></button>
</div>
HTML;

            }
        }

        $html .= <<<HTML
    <button value="$this->doc_id" name="textarea" class="add-section">Add Textarea</button>
    <button value="$this->doc_id" name="pre" class="add-section">Add Code Snippet</button>
</form>
HTML;
        return $title . $html;
    }

}
