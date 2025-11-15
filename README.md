# Basic-CRUD---Delete-Operation
Displays a list of all users and provides a link/button to initiate the delete operation for each record.

## 🛠️ Setup Instructions

To run these experiments locally, you will need a server environment with PHP and MySQL (e.g., XAMPP, MAMP, or WAMP).

1.  **Clone the Repository:**
    ```bash
    git clone [YOUR_REPOSITORY_URL]
    cd [repository-name]
    ```

2.  **Database Configuration:**
    * Start your Apache and MySQL services.
    * Open your MySQL tool (phpMyAdmin, etc.).
    * Execute the SQL commands in the `setup.sql` file (located in Experiment 1) to create the `web_experiment_db` database and the initial `users` table.
    * **CRITICAL:** Update the database connection credentials (`$servername`, `$username`, `$password`, `$dbname`) in **ALL** PHP files to match your local environment.

3.  **Run Experiments:**
    * Place all PHP and HTML files in your local web server's root directory (e.g., `/htdocs` or `/www`).
    * Access the files via your browser (e.g., `http://localhost/index.php`).

---

### 6. Basic CRUD - Delete Operation (DELETE)

| File | Description |
| :--- | :--- |
| `manage_users.php` | Lists all users with a "Delete" link for each. |
| `process_delete.php` | Securely receives the ID via a GET request and executes a **DELETE** query using **prepared statements** to remove the record from the database. |
