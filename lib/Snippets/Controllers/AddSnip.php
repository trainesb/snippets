<?php


namespace Controller;


use Snippets\Site;
use Table\Snip;

class AddSnip extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snips = new Snip($site);



        if(!empty($post)) {
            $snips->add($post);
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
