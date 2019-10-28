<?php


namespace Controller;


use Snippets\Site;
use Table\Snip;
use Table\Snippets;

class DeleteSnippet extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snippets = new Snippets($site);
        $snips = new Snip($site);

        if($snippets->deleteById($post['id'])) {
            if($snips->deleteBySnippetId($post['id'])) {
                $this->result = json_encode(["ok" => true]);
            } else {
                $this->result = json_encode(['ok' => false, 'message' => 'Error deleting snips']);
            }

        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
