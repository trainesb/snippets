<?php


namespace Controller;


use Snippets\Site;
use Table\Snippets;

class UpdateSnippet extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snippets = new Snippets($site);

        if($snippets->updateTitleById($post['title'], $post['snippets_id'])) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
