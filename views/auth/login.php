<div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">
    <h2 style="text-align: center; margin-top: 0;">Enterprise Login</h2>
    
    <?php if (isset($error)): ?>
        <div style="color: white; background: #ff4d4f; padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center;">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">อีเมล</label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px;">รหัสผ่าน (พิมพ์: password123)</label>
            <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <button type="submit" style="width: 100%; padding: 12px; background: #0056b3; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
            เข้าสู่ระบบ
        </button>
    </form>
</div>

<div class="w-full h-2 bg-red-300">

</div>