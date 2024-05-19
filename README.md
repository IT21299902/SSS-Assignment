# SSS-Assignment

# Cyber Chat

Welcome to the Cyber Chat repository, a secure web-based chat application. This application is designed to offer encrypted communication between users, ensuring privacy and security online. Below you will find detailed instructions for setting up the application both locally using XAMPP and online using 000webhost.

## Table of Contents

- [Installation](#installation)
- [Local Setup with XAMPP](#local-setup-with-xampp)
- [Online Deployment with 000webhost](#online-deployment-with-000webhost)
- [Running the Application](#running-the-application)
- [Testing](#testing)
- [Contributors](#contributors)
- [License](#license)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://your-repository-url.com
   cd cyber-chat

## local-setup-with-xampp

XAMPP is a free and open-source cross-platform web server solution stack package that makes it easy to install Apache distribution containing MySQL, PHP, and Perl.

1. ### Download and install XAMPP
        Go to XAMPP's official ("website https://www.apachefriends.org/download.html") and download the version compatible with your operating system.

2. ### Start XAMPP
        Launch XAMPP Control Panel and start Apache and MySQL.

3. ### Database Setup
        1. **Open XAMPP's PHPMyAdmin from your browser: http://localhost/phpmyadmin/** 
        2. **Create a new database named cyber_chat and import the cyber_chat.sql file provided in the repo.**

4. ### Configure PHP Application
        Modify the config/db.php file with the following settings:

        php

        <?php
        return [
            'host' => 'localhost',
            'username' => 'root', // Default XAMPP username
            'password' => '',     // Default XAMPP has no password
            'database' => 'cyber_chat'
        ];
        ?>
5. ### Set Up Virtual Host
Setting up a virtual host will allow you to access your application through a custom domain, such as `cyberchat.local`, instead of `localhost/cyber-chat`.

1. **Modify Apache Configuration**
   - Navigate to your XAMPP control panel folder, then to `apache\conf\extra\` and open `httpd-vhosts.conf`.
   - Add the following lines at the end of the file:
     ```apacheconf
     <VirtualHost *:80>
         ServerName cyberchat.local
         DocumentRoot "C:/xampp/htdocs/cyber-chat"
         <Directory "C:/xampp/htdocs/cyber-chat">
             Options Indexes FollowSymLinks
             AllowOverride All
             Require all granted
         </Directory>
     </VirtualHost>
     ```
   - Replace `"C:/xampp/htdocs/cyber-chat"` with the actual path to your project if it's located differently.

2. **Modify the Hosts File**
   - Open Notepad or any text editor as an administrator.
   - Open the hosts file located at `C:\Windows\System32\drivers\etc\hosts`.
   - Add the following line to the end of the file:
     ```
     127.0.0.1   cyberchat.local
     ```
   - Save the changes.

6. **Access the Application**
        Open your web browser and navigate to http://cyberchat.local.

## online-deployment-with-000webhost

000webhost is a free web hosting service that supports PHP and MySQL, making it suitable for hosting small to medium PHP applications.

1. ### Create an Account on 000webhost
        1. **Visit 000webhost.com and sign up for a free account.**

2. ### Upload Files
        2. **Go to the 000webhost control panel, navigate to the File Manager, and upload your project files to the public_html directory.**

3. ### Create a Database
        In the 000webhost dashboard, navigate to the Databases section and create a new database. Note the database name, username, and password.

4. ### Configure Database Connection
        Update the config/db.php with the database details provided by 000webhost.
        php

        <?php
        return [
            'host' => 'localhost',
            'username' => 'root', // 000webhost username
            'password' => '',     // 000webhost DB password
            'database' => 'cyber_chat' // 000webhost DB name
        ];
        ?>

6. ### Finalize Deployment
        Visit your project URL as specified by 000webhost to access the Cyber Chat application online.

## running-the-application

Refer to the Local Setup with XAMPP and Online Deployment with 000webhost sections for details on running the application locally and online.
