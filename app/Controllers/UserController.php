<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class UserController extends Controller {
    public function index() {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();

        $this->view('users_list', ['users' => $users]);
    }

    public function show($id) {
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if (!$user) {
            echo "ไม่พบข้อมูลของผู้ใช้งาน ID: " . htmlspecialchars($id);
        }

        echo "<h2>ข้อมูลส่วนตัวของ ID: $id</h2>";
        echo "<pre>";
        print_r($user);
        echo "</pre>";
    }

    public function edit($id) {
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if (!$user) {
            echo "ไม่พบข้อมูลพนักงาน!"; return;
        }

        $this->view('admin/edit_user', ['user' => $user]);
    }

    public function update($id) {
        $firstName = htmlspecialchars($_POST['first_name'] ?? '');
        $lastName  = htmlspecialchars($_POST['last_name'] ?? '');
        $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        $userModel = new UserModel();
        $userModel->updateUser($id, $firstName, $lastName, $email);

        header('Location: /admin/users');
        exit();
    }

    public function delete($id) {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("การกระทำไม่ถูกต้อง (Invalid CSRF Token)");
        }

        $userModel = new UserModel();
        $userModel->deleteUser($id);
        header('Location: /admin/users');
        exit();
    }
}