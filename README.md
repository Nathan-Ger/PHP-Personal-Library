# PHP Personal Library

## Overview of Project
This project was created for a class. The purpose is to allow a person (or group of people) have a personal library.
Essentially, you can register for an account, add books, and everything is only associated with the logged in account.
This project only uses a local server, but the premise would work very much for a live website.

## Installation Instructions

### Prerequisites
- **PHP**: - Make sure you are using PHP 7.4+
- **Development Stack**: - Ensure you have a development stack that supports PHP and MySQL. For these instructions I will be explaining using Ampps.
[AMPPS Download URL](https://ampps.com/downloads/)

### Setup
1. Once you have your development stack of choice, make sure have MySQL selected through it.
2. Clone the project into the proper folder for your stacks local server. In Ampps this is /Ampps/www/
3. Once you have completed this make sure to create a user for MySQL.
You once again need to find your stacks local MySQL file. In Ampps this is /Ampps/mysql/bin. By defualt the you can go here with
`cd C:\Program Files\Ampps\mysql\bin`.
4. Once you are at the location you must login as a admin. For Ampps you can do this by typing
`mysql -u root -pmysql`
5. Now you can create a database. You can do so with the following command
`CREATE DATABASE bcs350sp24;`.
6. You then need to create a new user. You can just copy the following command
`CREATE USER 'usersp24'@'localhost' IDENTIFIED BY 'pwdsp24';`
Then to give the user privileges to access the database you can type
`GRANT PRIVILEGES ON bcs350sp24.* TO 'usersp24'@'localhost';`.
7. Once you do this, it is time to setup the database.
Type localhost into your web browser of choice.
Then click PHP Personal Library, includes, and lastly setupDB.php.
This will then setup the database for use, as well as insert fake data for a user admin (the credentials are username = admin, password = mysql).
8. You are all done setting up the server and database for use!

## Usage
- You can now use this website how you would like. If you want to test some functions feel free to go to the loginForm.php page (inside of public_html/html). Where you can login as the admin, that already has test data.
- You can also create your own user by going to registerForm.php found within the same file as loginForm.php.
- After you have done this, go the the mainMenuForm.php (You will be led here automatically after logging in).
- From here you can list all of the data associated with your account, search through the data, delete data and even add more data.
- Everything is controlled through sessions, which helps determine whether you are logged in or not.

## Code Overview

### File Structure
- We have /includes which has some of the functions that interact with other files used in /html as well as the setup for the database.
- We have /public_html, which then has the sub directories of /css, /html, /javascript and /php.
- The /css folder is simply where I store the one-and-only style sheet.
- The /html folder is where all html code is stored, they are .php files, but this is mostly for session control.
- The /javascript folder store the validation .js functions that are used when validating data received as input.
- The /php folder is where I store the files that have data posted into them from /html, as well as the logout and delete files.
- Now we have /src, which is where the credentials and deleteAllTables files are. 

### Simple(ish) explanations of most of the files.
- databaseFunctions.php is where, almost, all database related function are performed. This includes basic utility functions, such as fix_string which just returns the string as htmlentities($string). There are functions for authorization, retrieving data, adding data and much more. This is probably the largest and messiest file I created, but for simplicity I wanted to keep it all in one file. Almost all the code is self explaining so feel free to read through.
- setupDB.php is where we create all the tables and insert testing data.
- validateFunctions.php is where we validate input through PHP. Does all the same tests as .js validation functions, but also checks the database for duplicate information.
- registerForm.php is the html that the user reaches when registering for a new account. Will return the user to mainMenuForm.php if they are already logged in.
- loginForm.php is the html that the user reaches when logging in for a new account. After registering you will be redirected here, and again, if you are logged in will send you to mainMenuForm.php
- mainMenuForm.php is the html that the user reaches after logging in. This page allows a user to list all data, search for data, or even add more data!
- listDataModule.php uses session control in conjunction with searchBookModule.php to display a list of books.
- searchBookModule.php takes a user input and selected option to search through the database and create session variables used in listDataModule.php. Will automatically redirect there after searching. .js validation is built into this file as it only requires one function.
- addBookModule.php takes user input to add a new book under their username.
- addBookValidation.js is the javascript validation for addBookModule.php.
- registerValidation.js is the javascript validation for registerForm.php.
- Instead of going through all of the php files, I will just say most simply send information to databaseFunctions.php to do what they want, the exlusions are below.
- logout.php will simply end the session.
- returnToMainMenu.php will send the user back to mainMenuForm.php while in any given module.
- credentials.php stores the information for the database, username and password for the database. This can easily be changed if you would like.
- deleteAllTables.php, this should never be used by a user, and only by someone testing data, but it, very simply, deletes all tables.

### Functions found within databaseFunctions.php
- For now this will remain empty, but I (maybe?) will add to it later!

## Things I want to change/add
- Below are what I wanted to add, but either didn't get time to, or just didn't want to add (laziness)
- All might be added in the future, again, no certainty on this.
- Make new tables for books that associates a user with a book_ID, and leave the books table to just store book data.
- Use some API to search for books to add.
- Make ALL error messages look better (They look horrible right now)
- Add a edit field on the listDataModule.php that leads the user to a new module to edit data related to their books.

## Ending
This is my first time writing php code, creating pages with html, and the first time I have ever tried to write documentation.
So I hope this all reads well and the code is, somewhat, well written!
Feel free to let me know anything you might recommend I change, or certainly some recommendations for documentation writing!
You can feel free to reach out to me at Nathanlgermain@gmail.com.
