<?php
session_start();
require_once 'config.php';
require_once 'config/social_login.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: users/dashboard.php");
    exit();
} elseif (isset($_SESSION['admin_id'])) {
    header("Location: admin/dashboard.php");
    exit();
}

$error = '';
$success = '';

// Handle error messages from social login callback
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password";
    } else {
        // First check admin credentials
        $stmt = $conn->prepare("SELECT id, username, password, role FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $admin_result = $stmt->get_result();
        
        if ($admin_result->num_rows == 1) {
            $admin = $admin_result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                // Admin login successful
                session_regenerate_id();
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_role'] = $admin['role'];
                
                header("Location: admin/dashboard.php");
                exit();
            }
        }
        
        // If not admin, check user credentials
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user_result = $stmt->get_result();
        
        if ($user_result->num_rows == 1) {
            $user = $user_result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // User login successful
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                header("Location: users/dashboard.php");
                exit();
            }
        }
        
        // If we get here, login failed
        $error = "Invalid username or password";
    }
}

$googleState = null;
function getGoogleAuthUrl() {
    $state = generateState();
    storeState($state);
    // Log the generated state to a file
    file_put_contents(__DIR__ . '/state_debug.log', date('Y-m-d H:i:s') . " | login.php | Generated state: $state\n", FILE_APPEND);
    $params = [
        'client_id' => GOOGLE_CLIENT_ID,
        'redirect_uri' => GOOGLE_REDIRECT_URI,
        'response_type' => 'code',
        'scope' => 'openid email profile',
        'state' => $state,
        'access_type' => 'offline'
    ];
    return GOOGLE_AUTH_URL . '?' . http_build_query($params);
}

function getFacebookAuthUrl() {
    $state = generateState();
    storeState($state);
    
    $params = [
        'client_id' => FACEBOOK_APP_ID,
        'redirect_uri' => FACEBOOK_REDIRECT_URI,
        'response_type' => 'code',
        'scope' => 'email public_profile',
        'state' => $state
    ];
    
    return FACEBOOK_AUTH_URL . '?' . http_build_query($params);
}

function getTwitterAuthUrl() {
    $state = generateState();
    storeState($state);
    
    // Generate PKCE code verifier and challenge
    $code_verifier = bin2hex(random_bytes(32));
    $code_challenge = base64_url_encode(hash('sha256', $code_verifier, true));
    
    $_SESSION['code_verifier'] = $code_verifier;
    
    $params = [
        'client_id' => TWITTER_CLIENT_ID,
        'redirect_uri' => TWITTER_REDIRECT_URI,
        'response_type' => 'code',
        'scope' => 'tweet.read users.read',
        'state' => $state,
        'code_challenge' => $code_challenge,
        'code_challenge_method' => 'S256'
    ];
    
    return TWITTER_AUTH_URL . '?' . http_build_query($params);
}

function base64_url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mental Health Support</title>
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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .logo-link {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
        }

        .logo-text {
            font-size: 2rem;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            display: flex;
            min-height: 600px;
        }

        .login-image {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1516302758847-719e4e3b9d1c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80') center/cover;
            opacity: 0.2;
        }

        .login-image h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            position: relative;
        }

        .login-image p {
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
        }

        .login-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h2 {
            color: var(--secondary-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .form-control {
            padding: 12px 15px 12px 45px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        }

        .btn-login {
            background: var(--primary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #357abd;
            transform: translateY(-2px);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
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
            .login-container {
                flex-direction: column;
            }

            .login-image {
                padding: 30px;
                min-height: 200px;
            }

            .login-form {
                padding: 30px;
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

    <div class="login-container">
        <div class="login-image">
            <h2>Welcome Back</h2>
            <p>Sign in to access your mental health support dashboard and continue your journey to better well-being.</p>
        </div>
        <div class="login-form">
            <h2>Sign In</h2>
            
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

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>
            </form>
            
            <div class="text-center my-3">
                <span style="color: #aaa; font-weight: 500;">or</span>
            </div>
            <div class="d-flex flex-column gap-2 mb-3">
                <a href="google_login.php" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center" style="font-weight:600;">
                    <i class="fab fa-google me-2"></i> Continue with Google
                </a>
                <a href="<?php echo getFacebookAuthUrl(); ?>" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center" style="font-weight:600;">
                    <i class="fab fa-facebook-f me-2"></i> Continue with Facebook
                </a>
                <a href="<?php echo getTwitterAuthUrl(); ?>" class="btn btn-outline-info w-100 d-flex align-items-center justify-content-center" style="font-weight:600;">
                    <i class="fab fa-twitter me-2"></i> Continue with Twitter
                </a>
            </div>
            <div class="register-link">
                Don't have an account? <a href="register.php">Register here</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
