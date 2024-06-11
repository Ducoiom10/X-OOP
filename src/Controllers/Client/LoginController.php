<?php 

namespace Ducna\XOop\Controllers\Client;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\User;

class LoginController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function showFormLogin() {
        auth_check();

        $this->renderViewClient('login');
    }

    public function login() {
        auth_check();

        try {
            if (!isset($_POST['email']) || !isset($_POST['password'])) {
                throw new \Exception('Vui lòng nhập email và mật khẩu.');
            }

            $user = $this->user->findByEmail($_POST['email']);

            if (empty($user)) {
                throw new \Exception('Không tồn tại email hoặc mật khẩu không đúng.');
            }

            $flag = password_verify($_POST['password'], $user['password']); 
            if ($flag) {
                $_SESSION['user'] = $user;
                $redirectUrl = $user['type'] == 'admin' ? url('admin') : url('');
                header('Location: '. $redirectUrl);
                exit;
            }

            throw new \Exception('Email hoặc mật khẩu không đúng.');
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            header('Location: ' . url('login'));
            exit;
        }
    }

    public function logout() {
        unset($_SESSION['user']);

        header('Location: ' . url('') );
        exit;
    }
}