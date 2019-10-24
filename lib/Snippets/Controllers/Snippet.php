<?php


namespace Controller;


use Snippets\Site;
use Table\Snippets;

class Snippet extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snippets = new Snippets($site);

        var_dump($post);

        if(!empty($post)) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
