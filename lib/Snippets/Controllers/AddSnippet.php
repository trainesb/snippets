<?php


namespace Controller;


use Snippets\Site;
use Table\Snippets;

class AddSnippet extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snippets = new Snippets($site);

        if(!empty($post)) {
            $id = $snippets->add($post);
            $this->result = json_encode(["ok" => true, "lang_id" => $post["language"], "snip_id" => $id]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
