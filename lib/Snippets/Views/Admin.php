<?php


namespace View;


use Snippets\Site;
use Table\Categories;
use Table\Topics;

class Admin extends View {

    protected $site;
    private $cat;
    private $topics;

    public function __construct(Site $site) {
        $this->site = $site;
        $this->cat = new Categories($site);
        $this->topics = new Topics($site);

        $this->setTitle("Admin");

        $this->addLink("./staff.php", "Staff");
        $this->addLink("post/logout.php", "Log Out");
    }

    public function newCatForm() {
        return <<<HTML
<form id="add-category" method="post" action="post/add-category.php">
    <fieldset>
        <legend>Add Category</legend>

        <p><label for="category">Category</label><br>
        <input type="text" id="category" name="category" placeholder="Category"></p>

        <p><input type="submit" value="Add Category"></p>

    </fieldset>
    
    <div class="message"></div>
</form>
HTML;

    }

    public function newTopicForm() {
        $allCat = $this->cat->getAll();

        $html = <<<HTML
<form id="add-topic" method="post" action="post/add-topic.php">
    <fieldset>
        <legend>Add Topic</legend>

        <p><label for="category">Language</label></p>
        <select class="category" name="category">
HTML;
        foreach ($allCat as $cat) {
            $html .= '<option value="'.$cat['id'].'">'.$cat['category'].'</option>';
        }

        $html .= <<<HTML
        </select>
        
        <p><label for="topic">Topic</label></p>
        <input type="text" id="topic" name="topic" placeholder="Topic">

        <p><input type="submit" value="Add Topic"></p>

    </fieldset>
    
    <div class="message"></div>
</form>
HTML;
        return $html;
    }

    public function TopicsTable() {
        $html = <<<HTML
<form class="table">
	<table>
		<tr>
			<th>&nbsp;</th>
			<th>id</th>
			<th>Topic</th>
			<th>Category_id</th>
		</tr>
HTML;
        $all = $this->topics->getAll();
        foreach ($all as $topic) {
            $id = $topic["id"];
            $category_id = $topic['cat_id'];
            $topic = $topic["topic"];

            $html .= <<<HTML
		<tr>
			<td><input type="radio" name="user"></td>
			<td>$id</td>
			<td>$topic</td>
			<td>$category_id</td>
		</tr>
HTML;
        }

        $html .= <<<HTML
	</table>
</form>
HTML;
        return $html;
    }

    public function CategoriesTable() {
        $html = <<<HTML
<form class="table">
	<table>
		<tr>
			<th>&nbsp;</th>
			<th>id</th>
			<th>Category</th>
		</tr>
HTML;
        $all = $this->cat->getAll();
        foreach ($all as $cat) {
            $id = $cat["id"];
            $name = $cat["category"];
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
