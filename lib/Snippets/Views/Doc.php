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

    public function docHeader() {
        $btn = $this->editBtn();
        return <<<HTML
<div class="head-link">
    <p><a href="./topic.php?cat=$this->cat&topic=$this->topic">$this->cat - $this->topic</a></p>
</div>
<div class="head-link right">
    $btn
</div>
<ul class="doc-info">
   <li>Doc: #$this->doc_id</li>
   <li>Author: $this->author</li>
   <li>Updated: $this->updated</li> 
</ul>
HTML;
    }

    public function editBtn() {
        if($this->mode == 'edit') {
            return '<p class="done-edit"><a href="./doc.php?cat='.$this->cat.'&topic='.$this->topic.'&id='.$this->doc_id.'&mode=view">Finish Editing</a></p>';
        }
        return '<p class="edit-snippet"><a href="./doc.php?cat='.$this->cat.'&topic='.$this->topic.'&id='.$this->doc_id.'&mode=edit">Edit Snippet</a></p>';
    }

    public function doc(){

        echo $this->docHeader();

        $editable = false;
        if($this->mode == 'view') {
            $editable = true;
            $html = '<h1 class="snippet-title center" contenteditable="'.$editable.'">'.$this->title.'</h1>';

            foreach ($this->sections as $section) {

                $text = $section['text'];
                if ($section['tag'] == 'pre') {
                    $text = str_replace("&amp;hellip;", "&hellip;", htmlspecialchars(base64_decode($text), ENT_QUOTES, 'UTF-8'));
                    $html .= '<pre id="' . $section["id"] . '"><code contenteditable="'.$editable.'">' . $text . '</code></pre>';
                } else {
                    $html .= '<p id="' . $section["id"] . '" contenteditable="'.$editable.'">' . $text . '</p>';
                }
            }
            return $html;
        } else {
            return $this->editDoc();
        }

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
    <div class="edit-section-btn">
        <button value="$this->doc_id" name="textarea" class="add-section">Add Textarea</button>
        <button value="$this->doc_id" name="pre" class="add-section">Add Code Snippet</button>
    </div>
</form>
HTML;
        return $title . $html;
    }

}
