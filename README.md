# ProjectHub — Project Idea Repository

**Course:** Database Management System  
**Unit:** Unit 4 — Advanced SQL and PL/SQL  
**Problem Statement:** #37 — Project Idea Repository  
**Project Type:** Individual Secure Hosted PHP–MySQL Mini Project

---

## 1. Selected Problem Statement

> **#37:** "Add project title, domain, description, technology, and guide requirement; search by domain."

---

## 2. Objective

To build a web-based **Project Idea Repository** that allows users to:
- Submit project ideas with title, domain, description, technology, and guide requirement
- View all stored project ideas from a MySQL database
- Search and filter project ideas by domain

The application demonstrates the complete flow: **HTML Form → PHP → MySQL (INSERT/SELECT) → Browser Output**, using secure prepared SQL statements.

---

## 3. Main Features

| Feature | Description |
|---------|-------------|
| Add Project Idea | HTML form to submit project details (5 fields) |
| View Projects | Displays all stored project ideas as cards |
| Search by Domain | Filter projects by domain using a dropdown |
| Prepared Statements | All user-input SQL queries use parameterized queries |
| Server-Side Validation | PHP validates all inputs before database insertion |
| XSS Protection | `htmlspecialchars()` used on all displayed database values |

---

## 4. Technology Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML, CSS |
| Backend | PHP |
| Database | MySQL |
| Hosting | InfinityFree |

---

## 5. Database Design

### Table: `project_ideas`

| Column | Data Type | Constraints |
|--------|-----------|------------|
| `project_id` | INT | PRIMARY KEY, AUTO_INCREMENT |
| `project_title` | VARCHAR(200) | NOT NULL |
| `domain` | VARCHAR(50) | NOT NULL |
| `description` | TEXT | NOT NULL |
| `technology` | VARCHAR(200) | NOT NULL |
| `guide_required` | VARCHAR(3) | NOT NULL |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |

### ER Diagram (Simple)

```
┌──────────────────────────────┐
│        project_ideas         │
├──────────────────────────────┤
│ PK  project_id    (INT, AI)  │
│     project_title (VARCHAR)  │
│     domain        (VARCHAR)  │
│     description   (TEXT)     │
│     technology    (VARCHAR)  │
│     guide_required(VARCHAR)  │
│     created_at    (TIMESTAMP)│
└──────────────────────────────┘
```

---

## 6. Application Flow

```
User visits Home Page (index.php)
        │
        ├──→ Add Project (add.php)
        │         │
        │         ▼
        │    HTML Form (5 fields)
        │         │
        │         ▼ POST
        │    save.php
        │         │
        │    ┌────┴────┐
        │    │ Server-  │
        │    │ Side     │
        │    │ Validate │
        │    └────┬────┘
        │         │
        │    ┌────┴──────────────┐
        │    │ Prepared INSERT   │
        │    │ INTO project_ideas│
        │    └────┬──────────────┘
        │         │
        │         ▼
        │    Success/Error Message
        │
        └──→ View Projects (view.php)
                  │
             ┌────┴────┐
             │ SELECT   │
             │ FROM     │
             │ project_ │
             │ ideas    │
             └────┬────┘
                  │
             ┌────┴─────────────┐
             │ Optional: WHERE  │
             │ domain = ?       │
             │ (Prepared Stmt)  │
             └────┬─────────────┘
                  │
                  ▼
             Display as Cards
             (htmlspecialchars)
```

---

## 7. SQL Operations Used

### INSERT (with Prepared Statement)
```php
$stmt = mysqli_prepare($conn,
    "INSERT INTO project_ideas
     (project_title, domain, description, technology, guide_required)
     VALUES (?, ?, ?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, "sssss",
    $project_title, $domain, $description,
    $technology, $guide_required
);
mysqli_stmt_execute($stmt);
```

### SELECT (All Projects)
```sql
SELECT project_id, project_title, domain, description,
       technology, guide_required
FROM project_ideas
ORDER BY project_id DESC
```

### SELECT with Filter (Prepared Statement)
```php
$stmt = mysqli_prepare($conn,
    "SELECT project_id, project_title, domain, description,
            technology, guide_required
     FROM project_ideas
     WHERE domain = ?
     ORDER BY project_id DESC"
);
mysqli_stmt_bind_param($stmt, "s", $selected_domain);
```

---

## 8. Security Implementation

| Security Measure | Implementation |
|-----------------|---------------|
| SQL Injection Prevention | Prepared statements with `?` placeholders for all user-input queries |
| XSS Prevention | `htmlspecialchars()` on all database values displayed in HTML |
| Server-Side Validation | All fields validated in PHP before INSERT |
| Domain Whitelisting | Only predefined domain values accepted |
| Guide Required Validation | Only "Yes" or "No" accepted |
| Error Hiding | Generic error messages shown to users; no DB internals exposed |
| Credential Separation | Database credentials in `config.php` only; `config.example.php` for sharing |

### Security Test

Input containing apostrophes (e.g., `O'Reilly's Smart Campus Assistant`) is handled safely by prepared statements — the value is inserted and displayed correctly without SQL errors or data corruption.

---

## 9. File Structure

```
ProjectHub/
├── index.php            # Home page
├── add.php              # Project submission form
├── save.php             # Form handler (INSERT with prepared statement)
├── view.php             # View & search projects (SELECT with filter)
├── config.php           # Database credentials (DO NOT share publicly)
├── config.example.php   # Example config with placeholder credentials
├── style.css            # External stylesheet
├── database.sql         # CREATE TABLE + sample INSERT records
├── README.md            # Project documentation
├── SCREENSHOT_GUIDE.md  # Screenshot checklist for assignment
└── screenshots/         # Folder for captured screenshots
```

---

## 10. Local Testing Instructions

### Prerequisites
- XAMPP, WAMP, or any local PHP/MySQL environment
- PHP 7.0+ with mysqli extension
- MySQL 5.7+

### Steps
1. Copy the `ProjectHub/` folder into your web server root (e.g., `htdocs/` for XAMPP)
2. Open phpMyAdmin and create a database named `projecthub_db`
3. Import `database.sql` into the database
4. Edit `config.php` with your local database credentials:
   - Host: `localhost`
   - User: `root`
   - Password: `` (empty for XAMPP)
   - Database: `projecthub_db`
5. Open `http://localhost/ProjectHub/` in your browser
6. Test all features: Add, View, Search, Security Test

---

## 11. InfinityFree Deployment Notes

### Steps
1. Sign up at [InfinityFree](https://www.infinityfree.com/)
2. Create a new hosting account
3. Go to **MySQL Databases** in the control panel
4. Create a new database — note the:
   - Database name
   - Database username
   - Database password
   - Database host (usually `sqlXXX.infinityfree.com`)
5. Open **phpMyAdmin** from the control panel
6. Import `database.sql` into your new database
7. Edit `config.php` with InfinityFree credentials
8. Upload all project files (except `config.example.php` and `README.md`) via the **File Manager** or FTP into `htdocs/`
9. Visit your site URL to verify

### Important Notes
- InfinityFree does **not** support `localhost` — use the actual database host
- File uploads go to the `htdocs/` directory
- PHP version is usually 7.4+
- Make sure `config.php` has the correct InfinityFree credentials

---

## 12. Security Test Instructions

1. Go to **Add Project**
2. Enter the following as the Project Title:
   ```
   O'Reilly's Smart Campus Assistant
   ```
3. Fill in remaining fields and submit
4. Go to **View Projects**
5. Verify the title displays correctly as: **O'Reilly's Smart Campus Assistant**
6. This proves prepared statements safely handle special characters

---

## 13. Required Screenshot Checklist

| # | Screenshot | What to Capture |
|---|-----------|----------------|
| 1 | Home / Data-Entry Form | Home page or the Add Project form |
| 2 | Completed Form | Form filled with sample data before clicking Submit |
| 3 | Successful INSERT | Success confirmation page after submission |
| 4 | Record List | View Projects page showing saved records |
| 5 | Search/Filter | View Projects filtered by a specific domain |
| 6 | Security Test | Successfully inserted record with apostrophe (O'Reilly) |
| 7 | Hosted URL | Application open in browser on InfinityFree URL |

---

## 14. Hosted URL

**Hosted URL:**  
[To be filled after InfinityFree deployment]

---

## 15. Declaration

This project is an original work developed as part of the DBMS Unit 4 Individual Mini Project assignment. The application demonstrates HTML Form → PHP → MySQL → SELECT/INSERT → Browser Output with secure prepared SQL statements.
 
