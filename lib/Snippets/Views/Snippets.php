<?php


namespace View;


use Table\Languages;

class Snippets extends View {


    protected $site;
    private $languages;
    private $snippets;
    private $query;
    private $langId;

    public function __construct($site, $user) {
        $this->site = $site;
        $this->languages = new Languages($site);
        $this->snippets = new \Table\Snippets($site);

        $this->query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $this->langId = $this->languages->getId($this->query)['id'];

        $this->setTitle($this->query);

        if($user) {
            if($user->isStaff()) {
                $this->addLink("./staff.php", "Staff");
            }
            $this->addLink("./profile.php", "Profile");
            $this->addLink("./logout,php", "Log Out");
        } else {
            $this->addLink("login.php", "Log In");
        }
    }

    public function present() {
        echo "<h1 class='center'>".$this->query." Snippets</h1>";

        echo $this->snippets();
    }

    public function snippets() {
        $snippets = $this->snippets->getById($this->langId);

        $html = <<<HTML
<form class="table">
	<table>
		<tr>
			<th>&nbsp;</th>
			<th>lang_id</th>
			<th>Title</th>
			<th>Code</th>
			<th>Description</th>
		</tr>
HTML;

        foreach ($snippets as $snippet) {
            $title = $snippet["title"];
            $description = $snippet["description"];
            $id = $snippet["lang_id"];
            $code = $snippet["code"];
            $html .= <<<HTML
		<tr>
			<td><input type="radio" name="user"></td>
			<td>$id</td>
			<td>$title</td>
			<td>$code</td>
			<td>$description</td>
		</tr>
HTML;
        }

        $html .= <<<HTML
	</table>
</form>
HTML;
        return $html;

    }


}
