<!-- login.php -->
<?php include('db.php'); session_start(); 
include('../config/db.php');

?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<form method="POST">
    Username or Email: <input type="text" name="user" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="login">Login</button>
</form>
<?php
if (isset($_POST['login'])) {
    $user = $conn->real_escape_string($_POST['user']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$user' OR email='$user'");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            $_SESSION['user'] = $data['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
</body>
</html>