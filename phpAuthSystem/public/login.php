<?php 
include __DIR__ . '/../config/db.php';
session_start();

// Handle login if form submitted
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
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Auth System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            color: white;
        }
        .auth-modal {
            background: rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
    <!-- Home Page Content -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Welcome Back!</h1>
            <p class="lead">Please login to access your dashboard</p>
            
            <!-- Login Trigger Button -->
            <button class="btn btn-light btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </button>
            
            <!-- Register Trigger Button -->
            <a href="register.php" class="btn btn-outline-light btn-lg mt-3 ms-2">
                <i class="fas fa-user-plus me-2"></i>Register
            </a>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade auth-modal" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel"><i class="fas fa-sign-in-alt me-2"></i>Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="user" class="form-label">Username or Email</label>
                            <input type="text" class="form-control" id="user" name="user" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <?php if(isset($login_error)): ?>
                            <div class="alert alert-danger"><?php echo $login_error; ?></div>
                        <?php endif; ?>
                        
                        <button type="submit" name="login" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <p class="mb-0">Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Auto-show modal if coming from register page or has error -->
    <?php if(isset($login_error) || (isset($_GET['from']) && $_GET['from'] == 'register')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    </script>
    <?php endif; ?>
</body>
</html>