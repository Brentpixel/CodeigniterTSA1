# IT0049 Technical Summative Assessment 1: Tasks for Today Management System

## About the Project
This project is a web-based **Tasks for Today Management System** built with **CodeIgniter 4 (PHP)** and **MySQL/MariaDB**. It displays today's tasks dynamically based on the system timezone (`Asia/Manila`), allows viewing all recorded tasks across multiple dates, shows demo user account details, and includes project information.

---

## 🛠️ Features & Requirements Checklist
- ✅ **CodeIgniter 4 Framework**: Organized using strict MVC (Model-View-Controller) architecture.
- ✅ **Database & Migrations**: Automated setup via CLI migrations (`CreateTasksTable`, `CreateUsersTable`) and seeders (`UserSeeder`, `TaskSeeder`, `DatabaseSeeder`).
- ✅ **SQL Export File**: Database structure and seed data exported at `database/tasks_today.sql`.
- ✅ **Dynamic Filtering**: Displays tasks scheduled specifically for "today" in `Asia/Manila` local time.
- ✅ **Responsive UI**: Custom CSS design system with glassmorphism aesthetics and status indicators (Done, In Progress, Pending).
- ✅ **Configured Routes**:
  - `/` — Dynamic homepage listing tasks scheduled for the current date.
  - `/tasks` — Full list of all tasks ordered by date descending.
  - `/profile` — Demo user profile information from the database (`users` table).
  - `/about` — Technical assessment details, architecture summary, and features.

---

## 🗄️ Database Schema

### `tasks` Table
```sql
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'pending',
  task_date DATE NOT NULL,
  created_at DATETIME NOT NULL
);
```

### `users` Table
```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  created_at DATETIME NOT NULL
);
```

---

## 🚀 Setup & Installation Instructions

### Prerequisites
- **XAMPP** (with PHP 8.1+ and MySQL/MariaDB enabled)
- **Composer** (optional, dependencies included)

### Step-by-Step Instructions

1. **Start MySQL Database**:
   Open XAMPP Control Panel and start **MySQL**.

2. **Create Database**:
   Run the following command in terminal or via phpMyAdmin:
   ```sql
   CREATE DATABASE tasks_today;
   ```

3. **Configure Environment Variables (`.env`)**:
   Ensure `.env` in the root directory contains:
   ```env
   database.default.hostname = localhost
   database.default.database = tasks_today
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   app.appTimezone = Asia/Manila
   ```

4. **Run Migrations & Seeders**:
   Execute the following CodeIgniter CLI commands:
   ```bash
   php spark migrate
   php spark db:seed DatabaseSeeder
   ```
   *(Alternatively, import `database/tasks_today.sql` into phpMyAdmin).*

5. **Start Application Server**:
   ```bash
   php spark serve
   ```
   Access the app in your browser at: [http://localhost:8080](http://localhost:8080)

---

## 📍 Route Summary
| Route | Controller Action | Description |
|---|---|---|
| `/` | `Home::index` | Displays tasks scheduled for the current date (`Asia/Manila`) |
| `/tasks` | `Tasks::index` | Displays all 8+ tasks across past, present, and future dates |
| `/profile` | `Profile::index` | Displays the demo user profile |
| `/about` | `About::index` | Explains project features and MVC breakdown |
