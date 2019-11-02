<?php


namespace View;


use Snippets\Site;
use Snippets\User;
use Table\Users;

class Profile extends View {

    private $user;
    private $user_id;
    private $mode;

    private $id;
    private $name;
    private $email;
    private $phone;
    private $joined;
    private $role;
    private $img;

    public function __construct(Site $site, $user) {

        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
        $this->id = $id;
        $this->mode = $mode;

        $users = new Users($site);
        $this->user = $users->get($this->id);

        if($user != null) {
            $this->user_id = $user->getId();
        }

        $this->name = $this->user->getName();
        $this->email = $this->user->getEmail();
        $this->phone = $this->user->getPhone();
        $this->joined = date("m-d-Y", $this->user->getJoined());
        $this->role = $this->user->getRole();
        $this->img = $this->user->getImg();

        $this->setTitle("Profile");

        if ($user != null) {
            if($user->isStaff()) {
                $this->addLink("./author.php", "Author");
            }
            if($user->isAdmin()) {
                $this->addLink("./admin.php", "Admin");
            }
            $this->addLink("post/logout.php", "Log Out");
        } else {
            $this->addLink("./login.php", "LoginForm");
        }
    }

    public function present() {
        if($this->isUser()) {
            $btn = $this->editBtn();
            if($this->mode == 'edit') {
                return $btn . $this->userCard(false);
            }
            return $btn . $this->userCard(true);
        }
        return $this->userCard(true);
    }

    public function isUser() {
        if($this->id === $this->user_id) {
            return true;
        }
        return false;
    }

    public function userCard($editable) {
        return <<<HTML
<div class="userCard" id="$this->id">
    <p class="user-name" contenteditable="$editable">Name: $this->name</p>
    <p class="user-email" contenteditable="$editable">Email: $this->email</p>
    <p class="user-phone" contenteditable="$editable">Phone: $this->phone</p>
    <p class="user-joined" contenteditable="$editable">Joined: $this->joined</p>
    <p class="user-role" contenteditable="$editable">Role: $this->role</p>
</div>
HTML;
    }

    public function editBtn() {
        if($this->mode == 'edit') {
            return '<div><a href="./profile.php?id='.$this->id.'&mode=view">Finish Editing</a></div>';
        }
        return '<div><a href="./profile.php?id='.$this->id.'&mode=edit">Edit Profile</a></div>';
    }

}
