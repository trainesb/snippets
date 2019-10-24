<?php


namespace View;


use Table\Languages;

class AddSnippet extends View {

    private $languages;

    public function __construct($site, $user) {
        $this->setTitle("Add Snippet");
        $this->languages = new Languages($site);
        $this->languages = $this->languages->getAll();


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
        echo "<h1 class='center'>Add Snippet</h1>";
        echo $this->snippetForm();
    }

    public function snippetForm() {
        $html = <<<HTML
<form id="add-snippet" method="post" action="post/add-snippet.php">
    <fieldset>
        <legend>Snippet</legend>
        
        <p><label for="language">Language</label></p>
        <select id="language" name="language">
HTML;

        foreach ($this->languages as $lang) {
            $html .= "<option value='".$lang['id']."'>".$lang['lang']."</option>";
        }

        $html .= <<<HTML
        </select>
        
        <p><label for="title">Title</label></p>
        <input type="text" id="title" name="title" placeholder="Title">

        <p><label for="snippet">Snippet</label><br>
        <input type="text" id="snippet" name="snippet" placeholder="Snippet"></p>

        <p><label for="description">Description</label></p>
        <input type="text" id="description" name="description" placeholder="description">

        <p><input type="submit" value="Add Snippet"></p>

    </fieldset>
    
    <div class="message"></div>
</form>
HTML;
        return $html;
    }
}
