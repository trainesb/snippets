<?php


namespace View;

use Table\Sections;
use Table\Tag;
use Table\Users;

class Doc extends View {

    protected $site;

    private $doc;
    private $sections;
    private $tags;

    //Document Variables
    private $doc_id;
    private $topic_id;
    private $author;
    private $title;
    private $updated;

    private $author_id;
    private $current_user_id;

    private $topic;
    private $cat;
    private $mode;

    public function __construct($site, $user) {
        $this->site = $site;
        $this->doc = new \Table\Doc($site);
        $this->sections = new Sections($site);
        $this->tags = new Tag($site);

        if($user != null) {
            $this->current_user_id = $user->getId();
        }

        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
        $this->topic = $topic;
        $this->mode = $mode;
        $this->doc_id = $id;
        $this->cat = $cat;

        $this->tags = $this->tags->getByDocId($this->doc_id);
        $this->sections = $this->sections->getByDocId($this->doc_id);

        $doc = $this->doc->getById($this->doc_id);
        $this->topic_id = $doc["topic_id"];
        $this->author = $doc["author"];
        $this->title = $doc["title"];
        $this->updated = date("d-m-Y", strtotime($doc["updated"]));

        $authorUser = new Users($this->site);
        $authorUser = $authorUser->get($this->author);
        $this->author = $authorUser->getName();
        $this->author_id = $authorUser->getId();

        $this->setTitle($this->title);

        if ($user) {
            if($user->isAdmin()) {
                $this->addLink("./admin.php", "Admin");
            }
            if ($user->isStaff()) {
                $this->addLink("./author.php", "Author");
            }
            $this->addLink("./profile.php?id=".$user->getId()."&mode=view", "Profile");
            $this->addLink("post/logout.php", "Log Out");
        } else {
            $this->addLink("login.php", "Log In");
        }
    }

    public function docHeader() {
        $html = <<<HTML
<div class="head-link">
    <p><a href="./topic.php?cat=$this->cat&topic=$this->topic">$this->cat - $this->topic</a></p>
</div>
<div class="head-link right">
HTML;

        if($this->author_id == $this->current_user_id) {
            if ($this->mode == 'edit') {
                $html .= '<p class="done-edit"><a href="./doc.php?cat=' . $this->cat . '&topic=' . $this->topic . '&id=' . $this->doc_id . '&mode=view">Finish Editing</a></p>';
            } else {
                $html .= '<p class="edit-snippet"><a href="./doc.php?cat=' . $this->cat . '&topic=' . $this->topic . '&id=' . $this->doc_id . '&mode=edit">Edit Snippet</a></p>';
            }
        }

        $html .= <<<HTML
</div>
<div class="info-wrapper">
    <ul class="doc-info">
       <li>Doc: #$this->doc_id</li>
       <li>Author: <a href="./profile.php?id=$this->author_id&mode=view">$this->author</a></li>
       <li>Updated: $this->updated</li> 
    </ul>
HTML;

        if(($this->author_id == $this->current_user_id) and ($this->mode == 'edit')) {
            $html .= '<ul class="tags edit">';
        } else {
            $html .= '<ul class="tags">';
        }

        foreach ($this->tags as $tag) {
            if(($this->author_id == $this->current_user_id) and ($this->mode == 'edit')) {
                $html .= '<li class="'.$tag["id"].'" contenteditable="true">'.$tag["tag"].'</li>';
            }
            $html .= '<li class="'.$tag["id"].'">'.$tag["tag"].'</li>';
        }

        if(($this->author_id == $this->current_user_id) and ($this->mode == 'edit')) {
            $html .= '<li class="new-tag" contenteditable="true"></li>';
        }

        $html .= <<<HTML
    </ul>
</div>
HTML;
        return $html;
    }

    public function doc(){

        echo $this->docHeader();
        $editable = true;
        $btn = '';

        if(($this->author_id == $this->current_user_id) and ($this->mode == 'edit')) {
            $editable = false;
            $btn = $this->addSectionBtn();
        }

        $html = '<div class="title-wrapper">';

        if(($this->author_id == $this->current_user_id) and ($this->mode == 'edit')) {
            $html .= '<h1 class="title edit" id="'.$this->doc_id.'" contenteditable="'.$editable.'">'.$this->title.'</h1></div>';
        } else {
            $html .= '<h1 class="title" id="'.$this->doc_id.'" contenteditable="'.$editable.'">'.$this->title.'</h1></div>';
        }

        $html .= '<div class="sections-wrapper">';
        foreach ($this->sections as $section) {

            $text = $section['text'];
            if(($this->author_id == $this->current_user_id) and ($this->mode == 'edit')) {
                $html .= '<div class="section-wrapper edit">';
            } else {
                $html .= '<div class="section-wrapper">';
            }
            if ($section['tag'] == 'pre') {
                $text = str_replace("&amp;hellip;", "&hellip;", htmlspecialchars(base64_decode($text), ENT_QUOTES, 'UTF-8'));
                $html .= '<pre id="' . $section["id"] . '" class="section code"><code contenteditable="'.$editable.'">' . $text . '</code></pre>';
            } else {
                $html .= '<p id="' . $section["id"] . '" class="section" contenteditable="'.$editable.'">' . $text . '</p>';
            }

            if(($this->author_id == $this->current_user_id) and ($this->mode == 'edit')) {
                $html .= '<button class="delete-section" id="'.$section["id"].'">Delete</button>';
                $html .= '<p class="display-checkbox"><input type="checkbox" class="doc-display" id="'.$section["id"].'"></p>';
            }

            $html .= "</div>";
        }

        return $html . $btn . "</div>";
    }

    public function addSectionBtn() {
        return <<<HTML
<div class="edit-section-btn">
    <button value="$this->doc_id" name="textarea" class="add-section">Add Textarea</button>
    <button value="$this->doc_id" name="pre" class="add-section">Add Code Snippet</button>
</div>
HTML;
    }

}
