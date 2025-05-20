<?php 
include __DIR__ . '/../config/db.php';
session_start();

// Handle registration if form submitted
if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE username='$username' OR email='$email'");
    
    if ($check->num_rows > 0) {
        $register_error = "Username or email already exists.";
    } else {
        $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
        header("Location: login.php?from=register");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Auth System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
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
            <h1 class="display-4 fw-bold">Join Us Today!</h1>
            <p class="lead">Create an account to get started</p>
            
            <!-- Register Trigger Button -->
            <button class="btn btn-light btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#registerModal">
                <i class="fas fa-user-plus me-2"></i>Register
            </button>
            
            <!-- Login Trigger Button -->
            <a href="login.php" class="btn btn-outline-light btn-lg mt-3 ms-2">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </a>
        </div>
    </section>

    <!-- Register Modal -->
    <div class="modal fade auth-modal" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel"><i class="fas fa-user-plus me-2"></i>Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <?php if(isset($register_error)): ?>
                            <div class="alert alert-danger"><?php echo $register_error; ?></div>
                        <?php endif; ?>
                        
                        <button type="submit" name="register" class="btn btn-primary w-100">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </button>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <p class="mb-0">Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Auto-show modal if has error -->
    <?php if(isset($register_error)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
            registerModal.show();
        });
    </script>
    <?php endif; ?>
</body>
</html>