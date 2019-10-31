<?php


namespace View;


use Table\Languages;

class View {
    private $title = "";
    private $links = [];
    private $protectRedirect = null;

    public function protect(Site $site, $user) {
        if($user->isAuthor()) {
            return true;
        }


        $this->protectRedirect = $site->getRoot() . "/";
        return false;
    }

    public function getProtectRedirect() {
        return $this->protectRedirect;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function addLink($href, $text) {
        $this->links[] = ["href" => $href, "text" => $text];
    }

    public function getTitle() {
        return $this->title;
    }

    public function head() {
        return <<<HTML
<meta charset="utf-8">
<title>$this->title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="dist/main.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
HTML;
    }

    public function nav() {
        $html = <<<HTML
<nav>
    <ul class="left">
        <li><a href="./">BT's Black Book</a></li>
    </ul>
HTML;

        if(count($this->links) > 0) {
            $html .= '<ul class="right">';
            foreach($this->links as $link) {
                $html .= '<li><a href="'.$link['href'].'">'.$link['text'].'</a></li>';
            }
            $html .= '</ul>';
        }


        $html .= '</nav>';
        return $html;
    }

    public function footer() {
        return <<<HTML
<footer><p>Copyright © 2019 BT. All Rights Reserved.</p></footer>
HTML;
    }
}
