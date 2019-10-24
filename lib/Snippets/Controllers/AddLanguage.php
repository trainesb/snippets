<?php


namespace Controller;


use Snippets\Site;
use Table\Languages;

class AddLanguage extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $languages = new Languages($site);
        if(!empty($post)) {
            $languages->add($post['language']);
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
