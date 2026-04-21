<h2>👥 รายชื่อผู้ใช้งานระบบ</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>อีเมล</th>
            
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <th style="text-align: center;">จัดการ</th>
            <?php endif; ?>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['first_name']) ?></td>
                <td><?= htmlspecialchars($user['last_name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <td style="text-align: center;">
                        <a href="/admin/users/edit/<?= $user['id'] ?>" style="color: #1890ff; text-decoration: none; margin-right: 10px;">✏️ แก้ไข</a>
                        <form action="/admin/users/delete/<?= $user['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('ยืนยันการลบ?');">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            
                            <button type="submit" style="background:none; border:none; color:#ff4d4f; cursor:pointer; text-decoration:underline;">
                                🗑️ ลบ
                            </button>
                        </form>
                    </td>
                <?php endif; ?>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>