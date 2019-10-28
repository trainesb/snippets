<?php


namespace Controller;


use Snippets\Site;
use Table\Sections;

class DeleteSection extends Controller {


    public function __construct(Site $site, array $post)
    {
        parent::__construct($site);

        $sections = new Sections($site);
        if ($sections->deleteByDocId($post['id'])) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error deleting snip!"]);
        }
    }
}