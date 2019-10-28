<?php


namespace Controller;


use Snippets\Site;
use Table\Doc;
use Table\Topics;

class AddDoc extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);
        $docs = new Doc($site);
        if($docs->createDoc($post['topic_id'])) {
            $id = $docs->getLastInsertedId();
            $this->result = json_encode(["ok" => true, "doc_id" => $id]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
