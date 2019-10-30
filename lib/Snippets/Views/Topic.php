<?php


namespace View;

use Table\Categories;
use Table\Sections;
use Table\Topics;

class Topic extends View {

    private $topics;
    private $categories;
    private $docs;
    private $sections;

    private $site;
    private $topic;
    private $topic_id;
    private $category;

    public function __construct($site, $user) {
        $this->site = $site;

        $this->topics = new Topics($this->site);
        $this->categories = new Categories($this->site);
        $this->docs = new \Table\Doc($site);
        $this->sections = new Sections($site);

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
            $this->addLink("./profile.php", "Profile");
            $this->addLink("./logout,php", "Log Out");
        } else {
            $this->addLink("login.php", "Log In");
        }
    }

    public function categories() {
        $all = $this->categories->getAll();

        $html = '<div class="category-container">';
        foreach ($all as $cat) {
            $html .= '<div class="category-list"><ul><li>'.$cat['category'].'<ul>';
            $cat_id = $cat['id'];
            $topics = $this->topics->getByCategoryId($cat_id);
            foreach ($topics as $topic) {
                $html .= '<li><a href="./topic.php?cat='.$cat['category'].'&topic='.$topic["topic"].'">'.$topic['topic'].'</a></li>';
            }

            $html .= '</ul></li></ul></div>';
        }
        return $html . '</div>';
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
<button class="create-doc" name="$this->topic_id" value="$this->topic" id="$this->category">Create Document</button>
HTML;
        }
        return null;
    }

    public function topicDocs() {
        $docs = $this->docs->getByTopicId($this->topic_id);

        $html = '<div class="container">';

        foreach ($docs as $doc) {
            $doc_id = $doc['id'];
            $title = $doc['title'];
            $html .= <<<HTML
<div class="doc-head">
    <p><a href="./doc.php?cat=$this->category&topic=$this->topic&id=$doc_id&mode=view">$title</a></p>
</div>
HTML;
            //    <button class="delete-doc" id='$doc_id' name='$title'><i class='fa fa-trash' aria-hidden='true'></i></button>
            $section = $this->sections->getByDocId($doc["id"]);
            if(!empty($section)) {
                $section = $section[0];

                if($section["tag"] == 'pre') {
                    $text = base64_decode($section['text']);
                    $html .= '<pre><code>'.$text.'</code></pre>';
                } else {
                    $text = $section['text'];
                    $html .= '<p>'.$text.'</p>';
                }
            }
        }
        return $html . '</div>';
    }
}
