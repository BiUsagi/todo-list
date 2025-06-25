# Sou Todo - Laravel Todo List

**Sou Todo** là ứng dụng quản lý công việc cá nhân (todo-list) được xây dựng với Laravel. Ứng dụng hỗ trợ xác thực người dùng, phân loại trạng thái công việc, deadline, và giao diện hiện đại, thân thiện.

---

## 🚀 Tính năng

-   Đăng ký, đăng nhập, xác thực người dùng (hỗ trợ Google OAuth)
-   Thêm, sửa, xóa, xem chi tiết công việc
-   Phân loại công việc: **Cần làm**, **Đang làm**, **Hoàn thành**
-   Đặt deadline cho từng công việc
-   Thống kê số lượng công việc theo trạng thái
-   Giao diện responsive, hỗ trợ **dark mode**
-   Quản lý, cập nhật thông tin cá nhân, đổi mật khẩu, xóa tài khoản

---

## 🛠️ Công nghệ sử dụng

-   **Backend:** Laravel (PHP)
-   **Frontend:** Bootstrap
-   **Database:** MySQL
-   **Template:** Blade

---

## ⚡ Cài đặt

1. **Clone dự án:**
    ```bash
    git clone https://github.com/BiUsagi/todo-list.git
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
4. **Chỉnh sửa thông tin kết nối database trong `.env`**
5. **Chạy migration và seed:**
    ```bash
    php artisan migrate --seed
    ```
6. **Build frontend:**
    ```bash
    npm run build
    ```
7. **Khởi động server:**
    ```bash
    php artisan serve
    ```
8. **Truy cập:** [http://localhost:8000](http://localhost:8000)

---

## 🧪 Kiểm thử tự động

-   Chạy toàn bộ test:
    ```bash
    php artisan test
    ```
-   Đảm bảo tất cả các test đều pass trước khi deploy.

---

## 🔒 Lưu ý bảo mật & Production

-   Không commit file `.env` lên git.
-   Đổi các giá trị mặc định trong `.env.example` khi triển khai thật.
-   Sử dụng HTTPS và cấu hình bảo mật cho server production.
-   Nên bật cache config/route/view khi chạy production:
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

---

## 📁 Cấu trúc chính

-   `app/Http/Controllers/`: Controller cho Auth, Todo, Profile
-   `app/Models/`: Model User, Todo
-   `resources/views/`: Giao diện Blade (index, profile, auth...)
-   `routes/web.php`: Định tuyến chính
-   `database/migrations/`: Các bảng users, todos, jobs, cache...
-   `public/`: Tài nguyên tĩnh, entrypoint

---

## 🤝 Đóng góp

Mọi đóng góp đều được hoan nghênh! Hãy tạo **pull request** hoặc **issue** nếu bạn có ý tưởng hoặc phát hiện lỗi.

---

## 📄 Thông tin & Giấy phép

-   Tác giả: [BiUsagi](https://github.com/BiUsagi)
-   License: MIT
