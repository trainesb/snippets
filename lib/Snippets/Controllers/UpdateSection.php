<?php


namespace Controller;


use Snippets\Site;
use Table\Sections;

class UpdateSection extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $sections = new Sections($site);

        $text = $post['text'];
        if($post['class'] == "code") {
            $text = base64_encode($text);
        }

        if($sections->updateTextById($text, $post['id'])) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
