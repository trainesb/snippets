<?php


namespace Controller;


use Snippets\Site;
use Table\Topics;

class AddTopic extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);
        $topics = new Topics($site);

        if($topics->add($post)) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
