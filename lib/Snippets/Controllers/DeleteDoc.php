<?php


namespace Controller;


use Snippets\Site;
use Table\Doc;
use Table\Sections;

class DeleteDoc extends Controller {


    public function __construct(Site $site, array $post)
    {
        parent::__construct($site);

        $doc = new Doc($site);
        $sections = new Sections($site);

        $doc_id = $post['doc_id'];

        if ($sections->deleteByDocId($doc_id)) {
            if($doc->deleteById($doc_id)) {
                $this->result = json_encode(["ok" => true]);
            } else {
                $this->result = json_encode(["ok" => false, "message" => "Error deleting Doc!"]);
            }
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error deleting Sections!"]);
        }
    }
}
