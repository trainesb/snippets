<?php


namespace Controller;


use Snippets\Site;
use Snippets\User;
use Table\Doc;

class AddDoc extends Controller {

    public function __construct(Site $site, User $user, array $post) {
        parent::__construct($site);
        $docs = new Doc($site);
        $author = $user->getId();
        if($docs->createDoc($post['topic_id'], $author)) {
            $id = $docs->getLastInsertedId();
            $this->result = json_encode(["ok" => true, "doc_id" => $id]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
