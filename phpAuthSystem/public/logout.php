<?php session_start();
include __DIR__ . '/../config/db.php';

session_destroy(); 
header("Location: login.php"); 
exit();

