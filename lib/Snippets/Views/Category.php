<?php


namespace View;


use Table\Categories;
use Table\Topics;

class Category extends View {

    private $cat;

    private $categories;
    private $topics;

    public function __construct($site, $user) {
        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
        $this->cat = $cat;

        $this->categories = new Categories($site);
        $this->topics = new Topics($site);
        $cat_id = $this->categories->getId($cat)['id'];
        $this->topics = $this->topics->getByCategoryId($cat_id);

        $this->setTitle($this->cat);

        if ($user) {
            if($user->isAdmin()) {
                $this->addLink("./admin.php", "Admin");
            }
            if ($user->isStaff()) {
                $this->addLink("./author.php", "Author");
            }
            $this->addLink("./profile.php?id=".$user->getId()."&mode=view", "Profile");
            $this->addLink("post/logout.php", "Log Out");
        } else {
            $this->addLink("./login.php", "Log In");
        }
    }

    public function present() {
        $title = $this->getTitle();
        $html = <<<HTML
<div class="category-title"><h1 class="center">$title</h1></div>
<ul>
HTML;
        foreach ($this->topics as $topic) {
            $html .= '<li><a href="./topic.php?cat='.$this->cat.'&topic='.$topic['topic'].'">'.$topic["topic"].'</a></li>';
        }

        return $html . '</ul>';
    }
}
