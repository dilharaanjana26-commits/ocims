# OCIMS (Online Class Institute Management System)

OCIMS is a Core PHP + MySQL (PDO) platform with Admin, Teacher, and Student roles. It ships with dashboards, batch management, class scheduling, manual/online payments (mock gateway), posts, reminders, and reports.

## Requirements
- XAMPP (Apache + MySQL + PHP 8+ recommended)
- Composer (for PHPMailer)

## Setup (XAMPP)
1. **Clone or copy** the project into your XAMPP `htdocs` folder.
2. **Create a database** named `ocims` in phpMyAdmin.
3. **Import schema + seed data**:
   - Import `database/schema.sql`
   - Import `database/migrations/002_seed.sql`
4. **Install dependencies**:
   ```bash
   composer install
   ```
5. **Configure environment**:
   - Copy `.env.example` to `.env` and update values if needed.
   - Ensure `BASE_URL` matches your setup, e.g. `http://localhost/ocims/public`
6. **Run the app**:
   - Visit `http://localhost/ocims/public/index.php`
   - If Apache rewrite is enabled, you can also use clean URLs. If not, the query string fallback works (`index.php?route=...`).

## Default Credentials (Seed Data)
- **Admin**: `admin@ocims.test` / `admin123`
- **Teacher 1**: `teacher1@ocims.test` / `teacher123`
- **Teacher 2**: `teacher2@ocims.test` / `teacher123`
- **Student 1**: `student1@ocims.test` / `student123`
- **Student 2**: `student2@ocims.test` / `student123`

## Manual Reminder Jobs (XAMPP)
Because XAMPP doesn’t always run cron jobs locally, trigger jobs from the Admin panel:
- Admin → Reminders → **Run Reminder Jobs Now**

You can also run the scripts directly:
```bash
php app/jobs/sms_reminder_cron.php
php app/jobs/email_reminder_cron.php
```

## Convenience Fee
Online student payments automatically apply a 5% convenience fee.
- Configure via `.env` (`CONVENIENCE_FEE_PERCENT=5`).

## Deploying to InfinityFree or a Paid Server
- Ensure `public/` is the web root and `app/` is outside the document root if possible.
- Update `.env` with production DB + SMTP settings.
- Upload all files (including `.htaccess`).
- For mail, configure SMTP (Mailgun can be set later via `.env` values).
- Set file permissions for `public/assets/uploads` to be writable.

## Setup Check Page
Admin → **Setup Check** validates:
- PDO MySQL extension
- Uploads folder writable
- SMTP + SMS config
- Base URL configuration

## Project Structure
```
public/index.php
app/config
app/core
app/controllers
app/models
app/services
app/views
app/jobs
```

## Notes
- Manual payments require proof upload (image/pdf).
- Teacher features are gated by active subscription.
- Student content access is gated by approved/captured payments.
