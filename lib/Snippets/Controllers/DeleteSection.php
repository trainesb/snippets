<?php


namespace Controller;


use Snippets\Site;
use Table\Doc;
use Table\Sections;

class DeleteSection extends Controller {


    public function __construct(Site $site, array $post)
    {
        parent::__construct($site);

        $doc = new Doc($site);
        $section_view_id = $doc->getSectionDisplay($post['doc_id']);

        if($section_view_id == $post['id']) {
            if(!$doc->updateDocDisplay($post['doc_id'], 0)) {
                $this->result = json_encode(["ok" => false, "message" => "Error removing the document section view."]);
            }
        }

        $sections = new Sections($site);
        if ($sections->deleteById($post['id'])) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error deleting snip!"]);
        }
    }
}
