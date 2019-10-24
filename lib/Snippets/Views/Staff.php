<?php


namespace View;


use Snippets\Site;
use Table\Languages;

class Staff extends View {

    protected $site;
    private $languages;

    public function __construct(Site $site) {
        $this->site = $site;
        $this->languages = new Languages($site);
        $this->languages = $this->languages->getAll();

        $this->setTitle("Staff");

        $this->addLink("./profile.php", "Profile");
        $this->addLink("post/logout.php", "Log Out");
    }

    public function present() {
        echo "<h1 class='center'>Staff</h1>";

        echo $this->languagesTable();
    }

    public function languagesTable() {
        $html = <<<HTML
<form class="table">
	<table>
		<tr>
			<th>&nbsp;</th>
			<th>id</th>
			<th>Language</th>
		</tr>
HTML;

        foreach ($this->languages as $lang) {
            $id = $lang["id"];
            $name = $lang["lang"];
            $html .= <<<HTML
		<tr>
			<td><input type="radio" name="user"></td>
			<td>$id</td>
			<td>$name</td>
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
