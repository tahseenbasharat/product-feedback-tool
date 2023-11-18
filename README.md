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

#### 3. Create Sample Data
Run `php artisan db:seed` to create sample data.
