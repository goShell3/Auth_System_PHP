<!-- register.php -->
<?php include('db.php'); session_start(); 
?>
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="register">Register</button>
</form>
<?php
if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE username='$username' OR email='$email'");
    if ($check->num_rows > 0) {
        echo "Username or email already exists.";
    } else {
        $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
        echo "Registered successfully. <a href='login.php'>Login here</a>";
    }
}
?>
</body>
</html>