<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private $connection;

    public function __construct() {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $db   = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $charset = $_ENV['DB_CHARSET'];

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

        $options = [
            // ให้ PDO แจ้งเตือนเมื่อเกิด Error (ดีมากสำหรับการ Dev)
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // คืนค่าผลลัพธ์เป็น Associative Array เสมอ (เช่น $row['username'])
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // ปิดการจำลอง Prepare Statement เพื่อให้ Database จัดการเอง (ปลอดภัยขึ้น)
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}