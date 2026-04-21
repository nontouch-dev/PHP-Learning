<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class AuthController extends Controller {
    public function loginForm() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /users');
            exit();
        }

        $this->view('auth/login', [], 'auth');
    }

    public function processLogin() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            
            if ($_SESSION['role'] == 'admin') {
                header('Location: /admin/users');
            } else {
                header('Location: /users/');
            }
            exit();
        } else {
            $this->view('auth/login', ['error' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง!'], 'auth');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit();
    }
}