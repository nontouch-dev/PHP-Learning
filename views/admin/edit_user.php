<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); max-width: 500px; margin: 0 auto;">
    <h2>✏️ แก้ไขข้อมูลพนักงาน (ID: <?= htmlspecialchars($user['id']) ?>)</h2>

    <form action="/admin/users/edit/<?= $user['id'] ?>" method="POST">
        
        <div style="margin-bottom: 15px;">
            <label>ชื่อ:</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>นามสกุล:</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label>อีเมล:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
            💾 บันทึกการเปลี่ยนแปลง
        </button>
        <a href="/admin/users" style="margin-left: 10px; color: #666; text-decoration: none;">ยกเลิก</a>
    </form>
</div>