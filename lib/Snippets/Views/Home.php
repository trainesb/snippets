<?php


namespace View;

use Table\Categories;
use Table\Topics;

class Home extends View {

    protected $site;

    private $categories;
    private $topics;


    public function __construct($site, $user) {
        $this->site = $site;

        $this->categories = new Categories($site);
        $this->topics = new Topics($site);

        $this->setTitle("Home");

        if ($user) {
            if($user->isAdmin()) {
                $this->addLink("./admin.php", "Admin");
            }
            if ($user->isStaff()) {
                $this->addLink("./staff.php", "Staff");
            }
            $this->addLink("./profile.php", "Profile");
            $this->addLink("./logout,php", "Log Out");
        } else {
            $this->addLink("login.php", "Log In");
        }
    }

    public function categories() {
        $all = $this->categories->getAll();

        $html = '<div class="category-container">';
        foreach ($all as $cat) {
            $html .= '<div class="category-list"><ul><li>'.$cat['category'].'<ul>';
            $cat_id = $cat['id'];
            $topics = $this->topics->getByCategoryId($cat_id);
            foreach ($topics as $topic) {
                $html .= '<li><a href="./topic.php?cat='.$cat['category'].'&topic='.$topic["topic"].'">'.$topic['topic'].'</a></li>';
            }

            $html .= '</ul></li></ul></div>';
        }
        return $html . '</div>';
    }

}
