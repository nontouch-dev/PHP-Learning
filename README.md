# 🚀 Enterprise PHP Application (MVC)

โปรเจกต์นี้คือแอปพลิเคชัน PHP ที่ถูกออกแบบด้วยสถาปัตยกรรม **MVC (Model-View-Controller)** แบบสร้างเอง (Custom Framework) ตามมาตรฐานการเขียนโปรแกรมระดับองค์กร (Enterprise Standard) โดยเน้นที่ความปลอดภัย ความเร็ว และประสบการณ์ของนักพัฒนา (Developer Experience) 

## ✨ จุดเด่นของโปรเจกต์ (Key Features)
- **MVC Architecture:** แยกการทำงานส่วนข้อมูล (Model), ส่วนแสดงผล (View), และส่วนควบคุม (Controller) ออกจากกันอย่างเด็ดขาด
- **Secure Database (PDO):** ใช้ PHP Data Objects (PDO) ควบคู่กับ Prepared Statements เพื่อป้องกัน SQL Injection แบบ 100%
- **Dynamic Routing:** ใช้ `bramus/router` แทนการใช้ `if-else` ปกติ รองรับ URL Parameters และ Middleware
- **Authentication & RBAC:** ระบบ Login/Logout ที่ใช้รหัสผ่านแบบ Hashing (`bcrypt`) พร้อมระบบจัดการสิทธิ์ (Role-Based Access Control) ดักจับด้วย Middleware
- **Modern Frontend Stack:** ติดตั้ง **Tailwind CSS v4** ผ่าน NPM พร้อมใช้ **BrowserSync** เพื่อการพัฒนาแบบ Real-time (ไม่ต้องกด Refresh หน้าเว็บเอง)
- **Dockerized:** พร้อมนำไปใช้งานจริงด้วย `Dockerfile` และ `docker-compose.yml` (PHP 8.3 + Apache + MySQL)
- **Secure Configuration:** ใช้ไฟล์ `.env` สำหรับเก็บค่าความลับของระบบ

---

## 📁 โครงสร้างโปรเจกต์ (Project Structure)

```text
├── app/                  # โฟลเดอร์หลักสำหรับ Logic ของระบบ (ห้าม User เข้าถึงโดยตรง)
│   ├── Controllers/      # รับ Request, ตรวจสอบสิทธิ์ และสั่งงาน Model / View
│   ├── Core/             # คลาสแกนกลางของระบบ เช่น Database Connection และ Base Controller
│   └── Models/           # คลาสสำหรับจัดการฐานข้อมูลโดยเฉพาะ (CRUD)
├── public/               # Document Root (เปิดให้ User เข้าถึงได้แค่โฟลเดอร์นี้)
│   ├── assets/           # ไฟล์ CSS, JS และรูปภาพ
│   │   └── css/          # มี input.css (ต้นฉบับ Tailwind) และ style.css (ไฟล์ที่ Build แล้ว)
│   ├── .htaccess         # กฎการทำ URL Rewrite และบังคับทุก Request ให้เข้าที่ index.php
│   └── index.php         # Front Controller และจุดศูนย์รวมของระบบ Routing
├── views/                # ไฟล์ HTML/PHP สำหรับแสดงผล
│   ├── admin/            # หน้าจอสำหรับ Admin (เช่น ฟอร์มแก้ไขข้อมูล)
│   ├── auth/             # หน้าจอเข้าสู่ระบบ (Login)
│   ├── layouts/          # โครงร่างหน้าเว็บ (Header/Footer) เช่น main.php และ auth.php
│   └── users_list.php    # หน้าแสดงตารางข้อมูลพนักงาน
├── .env.example          # ไฟล์ตัวอย่างสำหรับการตั้งค่า Environment
├── docker-compose.yml    # ไฟล์สำหรับรัน Server จำลองด้วย Docker
├── package.json          # ไฟล์จัดการ Frontend Dependencies (Tailwind, BrowserSync)
└── composer.json         # ไฟล์จัดการ Backend Dependencies (Router, Dotenv)