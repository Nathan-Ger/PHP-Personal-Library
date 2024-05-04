# PHP Personal Library

## Overview of Project
This project was created for a class. The purpose is to allow a person (or group of people) have a personal library.
Essentially, you can register for an account, add books, and everything is only associated with the logged in account.
This project only uses a local server, but the premise would work very much for a live website.

## Installation Instructions
PHP - Make sure you are using PHP 7.4+

Development Stack - Ensure you have a development stack that supports PHP and MySQL. For these instructions I will be explaining using Ampps.
[text](https://ampps.com/downloads/)

1. Once you have your development stack of choice, make sure have MySQL selected through it.
2. Clone the project into the proper folder for your stacks local server. In Ampps this is /Ampps/www/
3. Once you have completed this make sure to create a user for MySQL.
You once again need to find your stacks local MySQL file. In Ampps this is /Ampps/mysql/bin. By defualt the you can go here with "cd C:\Program Files\Ampps\mysql\bin".
4. Once you are at the location you must login as a admin. For Ampps you can do this by typing "mysql -u root -pmysql"
5. Now you can create a database. You can do so with the following command  "CREATE DATABASE bcs350sp24;".
6. You then need to create a new user. You can just copy the following command
"CREATE USER 'usersp24'@'localhost' IDENTIFIED BY 'pwdsp24';"
Then to give the user privileges to access the database you can type
"GRANT PRIVILEGES ON bcs350sp24.* TO 'usersp24'@'localhost';".
7. Once you do this, it is time to setup the database.
Type localhost into your web browser of choice.
Then click PHP Personal Library, includes, and lastly setupDB.php.
This will then setup the database for use, as well as insert fake data for a user admin (the credentials are username = admin, password = mysql).
8. You are all done setting up the server and database for use!

## Usage
You can now use this website how you would like. If you want to test some functions feel free to go to the loginForm.php page (inside of public_html/html). Where you can login as the admin, that already has test data.
You can also create your own user by going to registerForm.php found within the same file as loginForm.php.
After you have done this, go the the mainMenuForm.php (You will be led here automatically after logging in).
From here you can list all of the data associated with your account, search through the data, delete data and even add more data.
Everything is controlled through sessions, which helps determine whether you are logged in or not.

## Code Overview

## Ending
This is my first time writing php code, creating pages with html, and the first time I have ever tried to write documentation.
So I hope this all reads well and the code is, somewhat, well written!
Feel free to let me know anything you might recommend I change, or certainly some recommendations for documentation writing!
You can feel free to reach out to me at Nathanlgermain@gmail.com.