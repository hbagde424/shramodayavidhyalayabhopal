# सर्वोदय आवासीय विद्यालय — School Website (PHP + MySQL)

एक पूर्ण डायनामिक स्कूल वेबसाइट, जिसमें **एडमिन पैनल** से समाचार (News), गतिविधियां/इवेंट्स (Events), महत्वपूर्ण सूचनाएं (Notices) और फोटो गैलरी को जोड़ा/संपादित/हटाया जा सकता है।

## Tech Stack
- **Backend:** PHP 8 (Core PHP, MySQLi with Prepared Statements)
- **Database:** MySQL / MariaDB
- **Frontend:** HTML5, Bootstrap 5, Bootstrap Icons, Custom CSS, vanilla JS
- **Server:** Apache (XAMPP / LAMP / any standard PHP hosting)

This mirrors the same technology category used by most Indian government/school
websites (PHP + MySQL, server-rendered pages, session-based admin login,
file uploads stored on disk with paths saved in the DB) — but built as an
independent, original codebase (not copied HTML/CSS/JS from any existing site).

## Folder Structure
```
school_website/
├── index.php, about.php, academics.php, admission.php,
│   notices.php, gallery.php, contact.php     -> Public pages
├── includes/
│   ├── config.php     -> DB connection + site settings (EDIT THIS FIRST)
│   ├── header.php      -> Common header/nav
│   └── footer.php      -> Common footer
├── admin/
│   ├── login.php, logout.php, dashboard.php
│   ├── news_manage.php      -> Add/Edit/Delete News (with image upload)
│   ├── events_manage.php    -> Add/Edit/Delete Events (with image upload)
│   ├── notices_manage.php   -> Add/Edit/Delete Notices
│   ├── gallery_manage.php   -> Upload/Delete gallery photos (multi-upload)
│   ├── enquiries.php        -> View messages submitted from Contact page
│   └── includes/            -> Admin layout (sidebar/header/footer) + auth check
├── assets/
│   ├── css/style.css   -> Full custom theme (green + saffron)
│   ├── js/script.js
│   └── uploads/{news,events,gallery}  -> Uploaded images saved here
└── database/school_db.sql  -> Import this in phpMyAdmin to create DB + tables
```

## Setup Instructions (XAMPP / Local)

1. **Install XAMPP** (or any Apache+PHP+MySQL stack).
2. Copy the `school_website` folder into `htdocs` (e.g. `C:\xampp\htdocs\school_website`).
3. Start **Apache** and **MySQL** from the XAMPP control panel.
4. Open **phpMyAdmin** (`http://localhost/phpmyadmin`) → create a new database
   or simply **Import** the file `database/school_db.sql` (it creates the
   database `school_db` automatically along with all tables and demo data).
5. Open `includes/config.php` and update if needed:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'school_db');
   define('SITE_URL', 'http://localhost/school_website');
   ```
6. Visit `http://localhost/school_website/` in your browser — the site is live.

## Admin Panel Login
- URL: `http://localhost/school_website/admin/login.php`
- Username: `admin`
- Password: `admin123`

**⚠️ Important:** Change this password after first login (update the hash in
the `admins` table using `password_hash('yourNewPassword', PASSWORD_DEFAULT)`
in a small PHP snippet, or add a "change password" feature later).

## What the Admin Can Do
- **समाचार प्रबंधन (News):** Add/edit/delete news items with title, description,
  date, photo, and active/hidden toggle — instantly reflected on the homepage
  and Notices page.
- **गतिविधियां / इवेंट्स (Events):** Same CRUD flow for school events.
- **सूचनाएं (Notices):** Short text notices (with optional PDF/file link),
  shown in the scrolling notice bar on the homepage.
- **फोटो गैलरी (Gallery):** Bulk photo upload with captions; shown on the
  homepage preview and the full Gallery page.
- **संपर्क संदेश (Enquiries):** View messages submitted through the public
  Contact Us form.

## Customization Tips
- Change school name/tagline/contact info in `includes/config.php` and
  `includes/footer.php`.
- Replace the icon-based logo (`.school-logo` in `index.php`/`header.php`)
  with an actual `<img>` logo if you have one.
- Colors/theme can be changed from `assets/css/style.css` (`:root` variables
  at the top — currently deep green + saffron, different from the reference
  site's blue/red theme).

## Security Notes
- Passwords are hashed with PHP's `password_hash()` (bcrypt) — never stored
  in plain text.
- All database queries use **prepared statements** to prevent SQL Injection.
- Admin pages are protected by session checks (`admin/includes/auth_check.php`).
- File uploads are restricted to image extensions only (jpg, jpeg, png, webp, gif).
- Before going live: enable HTTPS, set strong admin password, and consider
  adding rate-limiting/captcha on the login form.
