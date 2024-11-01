# Contact Manager

## Database Migration

To set up the database for the Contact Manager project, follow these steps:

### Prerequisites

- Ensure you have MySQL installed and running on your machine.
- You need to have access to a MySQL user with privileges to create databases and tables.

### Steps to Migrate the Database

1. **Create the Database:**

   Open your MySQL command line or a MySQL client (like phpMyAdmin) and run the following command to create the database:

   ```sql
   CREATE DATABASE contact_manager;
   ```

2. **Create the `contacts` Table:**

   Switch to the `contact_manager` database and create the `contacts` table by running the following SQL command:

   ```sql
   USE contact_manager;

   CREATE TABLE contacts (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       email VARCHAR(255) NOT NULL,
       phone VARCHAR(20) NOT NULL,
       title VARCHAR(255) NOT NULL,
       created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
   );
   ```

3. **Configure Database Connection:**

   Ensure your database connection settings in the `functions.php` file are correct. The relevant section should look like this:

   ```php
   function pdo_connect_mysql() {
       $DATABASE_HOST = 'localhost';
       $DATABASE_USER = 'root';
       $DATABASE_PASS = '';
       $DATABASE_NAME = 'contact_manager';
       try {
           return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
       } catch (PDOException $exception) {
           exit('Failed to connect to database!');
       }
   }
   ```
   Adjust the `$DATABASE_HOST`, `$DATABASE_USER`, `$DATABASE_PASS`, and `$DATABASE_NAME` variables as needed.