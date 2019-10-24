<?php


namespace View;


class AddLanguage extends View {

    public function __construct($site, $user) {
        $this->setTitle("Add Language");

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
        echo "<h1 class='center'>Add Language</h1>";
        echo $this->languageForm();
    }

    public function languageForm() {
        return <<<HTML
<form id="add-language" method="post" action="post/add-language.php">
    <fieldset>
        <legend>Language</legend>

        <p><label for="language">Language</label><br>
        <input type="text" id="language" name="language" placeholder="Language"></p>

        <p><input type="submit" value="Add Lang"></p>

    </fieldset>
    
    <div class="message"></div>
</form>
HTML;
    }
}
