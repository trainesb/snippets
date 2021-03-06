<?php


namespace Controller;


use Snippets\Site;
use Table\Sections;

class AddSection extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $sections = new Sections($site);

        if($sections->add($post)) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
