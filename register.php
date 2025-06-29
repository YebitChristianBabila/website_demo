<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $profile_picture = null;

    // Validate username
    if (empty($username)) {
        $error = "Username is required";
    } elseif (strlen($username) < 3) {
        $error = "Username must be at least 3 characters long";
    }

    // Validate email
    if (empty($email)) {
        $error = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }

    // Validate password
    if (empty($password)) {
        $error = "Password is required";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    }

    // Validate password confirmation
    if ($password !== $confirm_password) {
        $error = "Passwords do not match";
    }

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['profile_picture']['type'], $allowed_types)) {
            $error = "Only JPG, PNG, and GIF images are allowed";
        } elseif ($_FILES['profile_picture']['size'] > $max_size) {
            $error = "Image size should not exceed 5MB";
        } else {
            // Create uploads directory if it doesn't exist
            $upload_dir = 'uploads/profile_pictures/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Generate unique filename
            $file_extension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $file_extension;
            $target_path = $upload_dir . $filename;

            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_path)) {
                $profile_picture = $target_path;
            } else {
                $error = "Failed to upload profile picture";
            }
        }
    }

    // If no errors, proceed with registration
    if (empty($error)) {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username or email already exists";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $profile_picture);

            if ($stmt->execute()) {
                $success = "Registration successful! You can now login.";
                // Redirect to login page after 2 seconds
                header("refresh:2;url=login.php");
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mental Health Support</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --text-color: #333;
            --light-bg: #f8f9fa;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--secondary-color);
        }

        .logo img {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            display: flex;
            min-height: 600px;
        }

        .register-image {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .register-image img {
            width: 150px;
            margin-bottom: 20px;
        }

        .register-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 2px solid #eee;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        }

        .btn-register {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: #357abd;
            transform: translateY(-2px);
        }

        .profile-picture-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
            border: 3px solid var(--primary-color);
        }

        .profile-picture-upload {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-picture-upload label {
            display: inline-block;
            padding: 10px 20px;
            background: var(--light-bg);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-picture-upload label:hover {
            background: #e9ecef;
        }

        .profile-picture-upload input[type="file"] {
            display: none;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #16a34a;
        }

        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
            }

            .register-image {
                padding: 20px;
            }

            .register-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="logo">
        <a href="index.php" class="logo-link">
            <img src="images/logo.jpg" alt="Logo">
            <span class="logo-text">NAYAS</span>
        </a>
    </div>
    <div class="register-container">
        <div class="register-image">
            <img src="images/logo.jpg" alt="Mental Health Support">
            <h2>Welcome to Mental Health Support</h2>
            <p>Join our community and take the first step towards better mental health.</p>
        </div>
        <div class="register-form">
            <h2 class="mb-4">Create Account</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" enctype="multipart/form-data">
                <div class="profile-picture-upload">
                    <img src="images/default-profile.jpg" alt="Profile Picture" class="profile-picture-preview" id="profilePreview">
                    <label for="profile_picture" class="btn btn-outline-primary">
                        <i class="fas fa-camera me-2"></i>
                        Choose Profile Picture
                    </label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewImage(this)">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <button type="submit" class="btn btn-register w-100">
                    <i class="fas fa-user-plus me-2"></i>
                    Register
                </button>

                <p class="text-center mt-3">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('profilePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
