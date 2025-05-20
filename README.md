# Auth_System_PHP
# PHP Authentication System

## 📁 Folder Structure

- `config/db.php` – MySQL connection
- `public/register.php` – Registration page
- `public/login.php` – Login page
- `public/dashboard.php` – Protected user dashboard
- `public/logout.php` – Logout handler
- `sql/auth_system.sql` – SQL script to create database and users table
- `assets/css/style.css` – Styles (Bootstrap/custom)

## ✅ Setup Instructions

1. **Import SQL**:
    - Open phpMyAdmin or use CLI:
    ```bash
    mysql -u root -p < sql/auth_system.sql
    ```

2. **Configure DB**:
    - Edit `config/db.php` with your MySQL credentials.

3. **Run the App**:
    - Put the project in your server’s root (`htdocs`, `www`, etc.).
    - Access via `http://localhost/auth_system/public/register.php`

4. **Login & Dashboard**:
    - After registration, log in to access the dashboard.

## 🔐 Security Notes

- Passwords are hashed using `password_hash()`.
- Sessions used for login state.

## 🚀 Future Improvements (Optional)

- Email verification
- Remember Me (cookies)
- Password reset
- CSRF protection
