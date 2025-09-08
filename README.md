Job Portal

A web-based Job Portal system built with HTML, CSS, PHP, JavaScript, and MySQL following the MVC architecture.
This project allows two types of users – Employers and Job Seekers – to interact through job postings and applications in a structured, user-friendly platform.

🚀 Features
👤 User Management

Registration with role selection (Job Seeker / Employer)

Secure login system (Email + Password)

JavaScript validation (password match, contact number length, etc.)

Profile update (name & contact number)

Change password functionality

💼 Employer Dashboard

Post new job listings (position, salary, working hours)

Manage posted jobs

Review and Approve / Deny job applications

🎯 Job Seeker Dashboard

View available job listings

Apply for jobs with one click

Track application status

🎨 Layout & Design

Responsive design with HTML & CSS

Consistent header, footer, and sidebar layout

Simple and clean user experience

🗂️ Project Structure
project/
│
├── controllers/
│   ├── registerController.php
│   ├── loginController.php
│
├── models/
│   ├── database.php
│
├── views/
│   ├── index.php
│   ├── login.php
│   ├── registration.php
│
├── style.css
└── README.md

🛠️ Tech Stack

Frontend: HTML, CSS, JavaScript

Backend: PHP (MVC)

Database: MySQL

Validation: JavaScript

⚙️ Installation & Setup

Clone this repository

git clone https://github.com/your-username/job-portal.git
cd job-portal


Import the database

Create a database named job in phpMyAdmin

Import the SQL file provided (job.sql)

Configure database connection

Update models/database.php with your database credentials

Start local server (using XAMPP/WAMP/MAMP) and run:

http://localhost/job-portal/views/index.php
