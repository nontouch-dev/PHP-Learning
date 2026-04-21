<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Setup</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <nav>
        <a href="/">หน้าแรก</a>
        
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="/admin/users">จัดการพนักงาน (Admin)</a>
            <a href="/admin/settings">ตั้งค่าระบบ</a>
        <?php else: ?>
            <a href="/users">รายชื่อเพื่อนร่วมงาน</a>
        <?php endif; ?>

        <a href="/logout" style="float: right; color: #ff4d4f;">
            ออกจากระบบ (<?= htmlspecialchars($_SESSION['user_name']) ?>)
        </a>
    </nav>

    <main>
        <?=  $content ?>
    </main>

    <footer>&copy; 2026 Enterprise App</footer>
</body>
</html>