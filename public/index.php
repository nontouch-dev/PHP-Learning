<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
}

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new \Bramus\Router\Router();
$namespace = '\App\Controllers';

$adminMiddleware = function() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /unauthorized'); 
        exit();
    }
};

$authMiddleware = function() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit();
    }
};

// (\d+): number  |  (\w+): string & number  |  (.*): all
$router->get('/login', $namespace . '\AuthController@loginForm');
$router->post('/login', $namespace . '\AuthController@processLogin');
$router->get('/logout', $namespace . '\AuthController@logout');


$router->before('GET|POST', '/users/.*', $authMiddleware);
$router->mount('/users', function() use ($router, $namespace) {
    $router->get('/', $namespace . '\HomeController@index');
    $router->get('/users', $namespace . '\UserController@index');
});


$router->before('GET|POST', '/admin/.*', $adminMiddleware);
$router->mount('/admin', function() use ($router, $namespace) {
    $router->get('/users', $namespace . '\UserController@index');
    $router->get('/users/(\d+)', $namespace . '\UserController@show');

    $router->get('/users/edit/(\d+)', $namespace . '\UserController@edit');
    $router->post('/users/edit/(\d+)', $namespace . '\UserController@update');
    $router->get('/users/delete/(\d+)', $namespace . '\UserController@delete');
});


$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "<h1>404 ไม่พบหน้าที่คุณต้องการ</h1>";
});


$router->get('/generate-hash', function() {
    // ใช้ PASSWORD_DEFAULT เพื่อให้ PHP เลือก Algorithm ที่ดีที่สุดในยุคนั้นให้ (ปัจจุบันคือ Bcrypt)
    $hash = password_hash('password', PASSWORD_DEFAULT);
    echo "นำข้อความนี้ไปใส่ในคอลัมน์ password ใน Database ของคุณ:<br><br>";
    echo "<b>" . $hash . "</b>";
});


$router->run();