<?php


namespace Controller;


use Snippets\Site;
use Table\Cookies;
use Table\Users;
use Snippets\User;

class Login extends Controller {

    private $redirect;	// Page we will redirect the user to.

    public function __construct(Site $site, array &$session, array $post) {
        parent::__construct($site);

        // Create a Users object to access the table
        $users = new Users($site);

        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);
        $user = $users->login($email, $password);
        $session[User::SESSION_NAME] = $user;

        if($user === null) {
            if(!$users->exists($email)) {
                $this->result = json_encode(['ok' => false, 'message' => 'Invalid Email']);
            } else {
                $this->result = json_encode(['ok' => false, 'message' => 'Invalid Password']);
            }
        } else {
            if($user->isAuthor()) {
                $this->result = json_encode(['ok' => true, 'author' => true]);
            } else {
                $this->result = json_encode(['ok' => true, 'author' => false]);
            }
        }

        if(isset($post['keep'])) {
            $cookies = new Cookies($site);
            $token = $cookies->create($user);
            $expire = time() + (86400 * 365); // 86400 = 1 day
            $user_id = $user->getId();
            $cookie = array("user" => $user_id, "token" => $token);
            setcookie(LOGIN_COOKIE, json_encode($cookie), $expire, "/");
        }
    }

}
