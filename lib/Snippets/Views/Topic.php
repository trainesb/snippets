<?php


namespace View;

use Table\Categories;
use Table\Topics;

class Topic extends View {

    private $topics;
    private $categories;
    private $docs;

    private $site;
    private $topic;
    private $topic_id;
    private $category;

    public function __construct($site, $user) {
        $this->site = $site;

        $this->topics = new Topics($this->site);
        $this->categories = new Categories($this->site);
        $this->docs = new \Table\Doc($site);

        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
        $this->topic = $topic;
        $this->category = $cat;

        $this->topic_id = $this->topics->getIdByTopic($this->topic);


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

    public function topicTitle() {
        $cat = $this->category;
        $topic = $this->topic;

        return <<<HTML
<h1 class="center">$cat - $topic</h1>
HTML;

    }

    public function createDoc() {
        if($this->topic_id) {
            return <<<HTML
<button class="create-doc" name="$this->topic_id" value="$this->topic">Create Document</button>
HTML;
        }
        return null;
    }

    public function topicDocs() {
        $docs = $this->docs->getByTopicId($this->topic_id);

        $html = '<div class="container">';

        foreach ($docs as $doc) {
            $html .= '<p><a href="./doc.php?topic='.$this->topic.'&id='.$doc["id"].'&mode=view">'.$doc["title"].'</a></p>';
        }
        return $html . '</div>';
    }
}
