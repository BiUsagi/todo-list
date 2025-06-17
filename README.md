# Sou Todo - Laravel Todo List

**Sou Todo** là ứng dụng quản lý công việc cá nhân (todo-list) được xây dựng với Laravel. Ứng dụng hỗ trợ xác thực người dùng, phân loại trạng thái công việc, deadline, và giao diện hiện đại, thân thiện.

---

## 🚀 Tính năng

- Đăng ký, đăng nhập, xác thực người dùng (hỗ trợ Google OAuth)
- Thêm, sửa, xóa, xem chi tiết công việc
- Phân loại công việc: **Cần làm**, **Đang làm**, **Hoàn thành**
- Đặt deadline cho từng công việc
- Thống kê số lượng công việc theo trạng thái
- Giao diện responsive, hỗ trợ **dark mode**
- Quản lý, cập nhật thông tin cá nhân, đổi mật khẩu, xóa tài khoản

---

## 🛠️ Công nghệ sử dụng

- **Backend:** Laravel (PHP)
- **Frontend:** Vite, Bootstrap
- **Database:** MySQL 
- **Template:** Blade

---

## ⚡ Cài đặt

1. **Clone dự án:**
    ```bash
    https://github.com/BiUsagi/todo-list.git
    cd todo-list
    ```

2. **Cài đặt dependencies:**
    ```bash
    composer install
    npm install
    ```

3. **Tạo file cấu hình môi trường:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Chạy migration và seed:**
    ```bash
    php artisan migrate --seed
    ```

5. **Build frontend:**
    ```bash
    npm run build
    ```

6. **Khởi động server:**
    ```bash
    php artisan serve
    ```

7. **Truy cập:** [http://localhost:8000](http://localhost:8000)

---

## 📁 Cấu trúc chính

- `app/Http/Controllers/`: Controller cho Auth, Todo, Profile
- `app/Models/`: Model User, Todo
- `resources/views/`: Giao diện Blade (index, profile, auth...)
- `routes/web.php`: Định tuyến chính
- `database/migrations/`: Các bảng users, todos, jobs, cache...
- `public/`: Tài nguyên tĩnh, entrypoint

---

## 🤝 Đóng góp

Mọi đóng góp đều được hoan nghênh! Hãy tạo **pull request** hoặc **issue** nếu bạn có ý tưởng hoặc phát hiện lỗi.

---
