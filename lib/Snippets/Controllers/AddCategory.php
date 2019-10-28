<?php


namespace Controller;


use Snippets\Site;
use Table\Categories;

class AddCategory extends Controller {

    public function __construct(Site $site, array $post) {
        parent::__construct($site);
        $categories = new Categories($site);
        if($categories->add($post['category'])) {
            $this->result = json_encode(["ok" => true]);
        } else {
            $this->result = json_encode(["ok" => false, "message" => "Error"]);
        }
    }
}
