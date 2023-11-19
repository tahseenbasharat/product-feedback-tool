### Application Overview
a web-based Product Feedback Tool that allows users to submit, view, and vote on product feedback. The tool should facilitate communication between users and the product development team.

### Steps to run project 

#### 1. Project Requirements
- PHP 8.1
- MySQL 5.7 or greater
<br/><br/>

#### 2. `.env` Configuration

```
// define your application name
APP_NAME="Product Feedback Tool"

// define your database connection
DB_HOST="your-database-host"
DB_PORT="your-database-port"
DB_DATABASE="your-database-name"
DB_USERNAME="your-database-username"
DB_PASSWORD="your-database-password"
```
<br/>

#### 3. Create Database Tables
Run `php artisan migrate` to run migrations.
<br/><br/>

#### 4. Create Sample Data
Run `php artisan db:seed` to create sample data.

*Note: Admin account also created by running seeder*
<br/><br/>

#### 5. Run Project
Run `php artisan server` to start your project.

Development URL: [http://localhost:8000/](http://localhost:8000)
<br/><br/>

#### 6. Login credentials to test app
```
// Admin credentials
username: admin
password: admin

// Testing User's Credentials
username: tahseenbasharat
password: password

Note: Other user can be logged in by getting their username from database. Use "password" as value for the password field
```
