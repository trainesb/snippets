<?php


namespace Controller;


use Snippets\Site;
use Table\Snippets;

class AddSnippet extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snippets = new Snippets($site);



        if(!empty($post)) {

            $snippets->createSnippet($post['lang_id']);
            $id = $snippets->getLastInsertedId()['MAX(id)'];
            $this->result = json_encode(["ok" => true, "id" => $id]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
