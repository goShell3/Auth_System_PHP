<!-- dashboard.php -->
<?php session_start(); 
include('../config/db.php');


if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); } 

?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
<a href="logout.php">Logout</a>
</body>
</html>