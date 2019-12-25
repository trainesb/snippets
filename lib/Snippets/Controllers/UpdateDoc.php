<?php


namespace Controller;


use Snippets\Site;
use Table\Doc;

class UpdateDoc extends Controller {

    private $doc;

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $this->doc = new Doc($site);

        if($post['type'] == "title") {
            $this->updateTitle($post['title'], $post['topic_id']);
        } else {
            $this->updateDocDisplay($post['doc_id'], $post['section_id']);
        }
    }

    public function updateDocDisplay($doc_id, $section_id) {
        if($this->doc->updateDocDisplay($doc_id, $section_id)) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }

    public function updateTitle($title, $topic_id) {
        if($this->doc->updateTitleById($title, $topic_id)) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
