<?php


namespace Controller;


use Snippets\Site;
use Table\Snip;

class UpdateSnip extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snips = new Snip($site);
        $text = $post['text'];
        if($post['class'] == "code") {
            $text = base64_encode($text);
        }

        if($snips->updateTextById($text, $post['id'])) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}

