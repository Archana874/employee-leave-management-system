# Employee Leave Management System

## Project Overview

Employee Leave Management System is a web-based application developed using PHP, MySQL, HTML5, CSS3, JavaScript, AJAX, and Bootstrap.

The system allows employees to apply for leave, managers to approve or reject leave requests, and administrators to manage users, leave types, reports, and overall system configuration.

---

## Features

### Administrator

* Dashboard with leave statistics
* User Management
* Leave Configuration Management
* Leave Reports
* Audit Log Tracking

### Manager

* Dashboard
* Leave Approval
* Leave Rejection with Remarks
* Leave Request Monitoring

### Employee

* Dashboard
* Apply Leave
* View Leave History
* Leave Status Tracking
* Leave Balance Monitoring

---

## Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap 5
* AJAX

### Backend

* PHP

### Database

* MySQL

---

## Database Setup

1. Create a database named:
leave_management(SQL)

2. Import the SQL file:
leave_management.sql

using phpMyAdmin or MySQL command line.

---

## Database Configuration

Update the database configuration in:

php/database.php

Example:

php:
$host = "localhost";
$username = "root";
$password = "";
$database = "leave_management";

---

## Steps to Run the Application

1. Install XAMPP.
2. Start Apache and MySQL services.
3. Copy the project folder into:


htdocs/


4. Import:


leave_management.sql


into MySQL.

5. Configure database settings in:

php/database.php


6. Open browser and access:


http://localhost/leave-management-system/html/Login.html


---

## Test Credentials

### Admin

Email:admin@test.com
Password:password

### Manager

Email:manager@test.com
Password:password

### Employee

Email:john@mail.com
Password:password

Note: Update credentials according to the records available in your SQL file.

---

## Business Rules Implemented

* Employee cannot apply leave with insufficient balance.
* Employee cannot apply overlapping leave requests.
* Leave balance is deducted only after manager approval.
* Manager remarks are mandatory for rejected leave requests.
* Status tracking available for all leave requests.
* Audit logs are maintained for important activities.

---

## Audit Logging

The system records the following activities:

* Leave Application
* Leave Approval
* Leave Rejection

Audit records are stored in:

audit_logs

table.

---

## Assumptions

* One employee belongs to one user account.
* Leave balance is maintained separately for each leave type.
* Only managers can approve or reject leave requests.
* User accounts can be activated or deactivated by administrators.
* Audit logs are maintained for tracking major activities.

---

## Project Structure


leave-management-system
│
├── css
├── html
├── js
├── php
├── screenshots
├── leave_management.sql
└── README.md

---

## Screenshots

Screenshots of major application screens are included in the screenshots folder.

* Login Page
* Admin Dashboard
* Employee Dashboard
* Manager Dashboard
* Apply Leave
* Leave History
* Leave Approval
* Leave Configuration
* Reports

---

## Author

Archana K R

Employee Leave Management System Assignment Submission
