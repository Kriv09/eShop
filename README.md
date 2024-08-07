# eShop

## Introduction

eShop is an online shopping platform built with PHP and PDO for database connectivity. It provides a simple yet effective way for users to browse, search, and purchase products conveniently from the comfort of their homes. This README file serves as a guide for setting up and understanding the project.

## Features

- User-friendly interface for easy navigation.
- Secure user authentication and authorization.
- Product browsing by category or search.
- Add products to the shopping cart for easy checkout.

## Requirements

To run eShop on your server, ensure you have the following:

- PHP (version 8.0 - 8.1)
- MySQL or MariaDB database
- Open Server Panel (Apache 2.5 + PHP 8.0 - 8.1 + Nginx 1.23)

## Installation

1. *Clone the Repository*

   Clone the repository to your local machine or server:

   ```
   git clone https://github.com/yourusername/eShop.git
   ```
2. *Import the Database* : _Import the provided SQL file (eShopDB_init.sql) into your MySQL or MariaDB database to set up the required tables and sample data._
3. *Configure Database Connection* : _Configure the database connection in db_params.php as follows:_
```
<?php
return array(
    'host' => 'localhost',
    'dbname' => '*Your Database Name*',
    'user' => '*Your Username*',
    'password' => '*Your Password*',
);
?>
```
4. *Set Permissions* : _Ensure that the uploads directory has write permissions for storing product images._
5. *Start the Web Server* : _Start your web server and navigate to the project directory in your web browser. You should be greeted with the eShop homepage. You can now register an account, browse products, and make purchases._

## Configuration
- **Application Access:** _After installation, you can access the application by visiting the root URL (/)._

## Customization
_You can customize the project by modifying the PHP and HTML files in the src directory. Add your own stylesheets, scripts, or additional features as needed._
