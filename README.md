# Product Management System (Laravel 12)

A complete, production-ready Full-Stack Product Management System built with **Laravel 12** and **MySQL**. This project features a Web Dashboard with a beautiful UI (Bootstrap 5) and a secure REST API for external applications.

## 🚀 Features

### Web Interface
- **Secure Authentication:** Registration and Login using Laravel's session auth.
- **Admin Dashboard:** Overview of total products, active/inactive counts, and recent additions.
- **Full CRUD Operations:** Create, Read, Update, and Delete products.
- **Image Management:** Upload product images with previews, and remove existing ones. Images are stored securely and served efficiently.
- **Sorting & Search:** Easily filter and sort products by name, category, price, or date.
- **Modern UI:** Built with Bootstrap 5, featuring a responsive, clean, and interactive design.

### REST API
- **Token-based Authentication:** Custom lightweight Bearer token implementation without the overhead of Sanctum/Passport.
- **Public Endpoints:** Fetch all products or a single product without authentication.
- **Protected Endpoints:** Create, Update, and Delete operations require a valid `Bearer Token` in the `Authorization` header.
- **Standardized Responses:** Clean JSON responses for success, validation errors, and 404s.

## 🛠️ Technology Stack
- **Backend:** Laravel 12 (PHP 8.3+)
- **Database:** MySQL
- **Frontend:** Blade Templates, Bootstrap 5, Vanilla CSS/JS
- **Storage:** Local Storage (`storage/app/public`)

## 📦 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone <your-repository-url>
   cd ProductManagement
   ```

2. **Install Composer Dependencies:**
   ```bash
   composer install
   ```

3. **Environment Setup:**
   ```bash
   cp .env.example .env
   ```
   *Make sure to configure your database settings in the `.env` file.*

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate --seed
   ```
   *This will create the necessary tables and populate the database with a default Admin user and sample products.*

6. **Link Storage:**
   ```bash
   php artisan storage:link
   ```
   *Note: A fallback route has been implemented in `web.php` (`/media/{path}`) to bypass Windows local PHP built-in server symlink issues.*

7. **Start the Development Server:**
   ```bash
   php artisan serve
   ```
   Access the app at: `http://127.0.0.1:8000`

