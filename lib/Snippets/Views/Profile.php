<?php


namespace View;


use Snippets\Site;
use Snippets\User;

class Profile extends View {

    private $id;
    private $name;
    private $email;
    private $phone;
    private $joined;
    private $role;

    public function __construct(Site $site, User $user) {
        $this->id = $user->getId();
        $this->name = $user->getName();
        $this->email = $user->getEmail();
        $this->phone = $user->getPhone();
        $this->joined = date("m-d-Y", $user->getJoined());
        $this->role = $user->getRole();

        $this->setTitle("Profile");

        $this->addLink("./staff.php", "Staff");
        $this->addLink("post/logout.php", "Log Out");
    }

    public function userCard() {
        return <<<HTML
<div class="userCard" id="$this->id">
    <p class="user-name">Name: $this->name</p>
    <p class="user-email">Email: $this->email</p>
    <p class="user-phone">Phone: $this->phone</p>
    <p class="user-joined">Joined: $this->joined</p>
    <p class="user-role">Role: $this->role</p>
</div>
HTML;
    }

}
