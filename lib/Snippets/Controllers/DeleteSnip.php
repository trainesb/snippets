<?php


namespace Controller;


use Snippets\Site;
use Table\Snip;

class DeleteSnip extends Controller {


    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snips = new Snip($site);
        if($snips->deleteSnipById($post['id'])) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error deleting snip!"]);
        }
    }
}
