<?php

session_start();

session_unset();
require 'database.php';
require 'audit_helper.php';

if(isset($_SESSION['user_id']))
{
    addAuditLog(
        $conn,
        $_SESSION['user_id'],
        'User Logged Out'
    );
}
session_destroy();

header("Location: ../html/login.html");

exit;

?>