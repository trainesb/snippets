<?php


namespace Controller;


use Snippets\Site;
use Table\Snip;
use Table\Snippets;

class Snippet extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);

        $snippets = new Snippets($site);
        $snips = new Snip($site);

        if(!empty($post)) {

            if(!$snippets->updateTitleById($post['title'], $post['snippet_id'])) {
                $this->result(["ok"=>false, "message"=> "Error updating title"]);
                return;
            }

            foreach ($post['data'] as $snip) {

                if(!empty($snip['snip_id'])) {

                    $text = '';

                    if(!empty($snip['text'])) {
                        $text = $snip['text'];
                    }

                    if (!empty($snip['code'])) {
                        $text = base64_encode($snip['code']);
                    }

                    if(!$snips->updateTextById($text, $snip['snip_id'])) {
                            $this->result(["ok"=>false, "message"=> "Error updating text"]);
                            return;
                    }


                } else {

                    if(!empty($snip['text'])) {
                        $tag = 'textarea';
                        $text = $snip['text'];
                    } else {
                        $tag = 'pre';
                        $text = $snip['code'];
                    }
                    if(!empty($text)) {
                        $snippet_id = $post['snippet_id'];
                        $snip = ['text' => $text, 'snippets_id' => $snippet_id, 'tag' => $tag];
                        if (!$snips->add($snip)) {
                            $this->result(["ok" => false, "message" => "Error Adding new Snip!"]);
                            return;
                        }
                    }

                }
            }

            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
