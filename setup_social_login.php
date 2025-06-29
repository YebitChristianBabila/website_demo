<?php
session_start();
require_once 'config/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config_content = "<?php\n";
    $config_content .= "// Social Media Login Configuration\n";
    $config_content .= "// Generated on " . date('Y-m-d H:i:s') . "\n\n";
    
    $config_content .= "// Google OAuth Configuration\n";
    $config_content .= "define('GOOGLE_CLIENT_ID', '" . addslashes($_POST['google_client_id']) . "');\n";
    $config_content .= "define('GOOGLE_CLIENT_SECRET', '" . addslashes($_POST['google_client_secret']) . "');\n";
    $config_content .= "define('GOOGLE_REDIRECT_URI', '" . addslashes($_POST['google_redirect_uri']) . "');\n\n";
    
    $config_content .= "// Facebook OAuth Configuration\n";
    $config_content .= "define('FACEBOOK_APP_ID', '" . addslashes($_POST['facebook_app_id']) . "');\n";
    $config_content .= "define('FACEBOOK_APP_SECRET', '" . addslashes($_POST['facebook_app_secret']) . "');\n";
    $config_content .= "define('FACEBOOK_REDIRECT_URI', '" . addslashes($_POST['facebook_redirect_uri']) . "');\n\n";
    
    $config_content .= "// Twitter OAuth Configuration\n";
    $config_content .= "define('TWITTER_CLIENT_ID', '" . addslashes($_POST['twitter_client_id']) . "');\n";
    $config_content .= "define('TWITTER_CLIENT_SECRET', '" . addslashes($_POST['twitter_client_secret']) . "');\n";
    $config_content .= "define('TWITTER_REDIRECT_URI', '" . addslashes($_POST['twitter_redirect_uri']) . "');\n\n";
    
    $config_content .= "// Base URLs for OAuth\n";
    $config_content .= "define('GOOGLE_AUTH_URL', 'https://accounts.google.com/o/oauth2/v2/auth');\n";
    $config_content .= "define('GOOGLE_TOKEN_URL', 'https://oauth2.googleapis.com/token');\n";
    $config_content .= "define('GOOGLE_USERINFO_URL', 'https://www.googleapis.com/oauth2/v2/userinfo');\n\n";
    
    $config_content .= "define('FACEBOOK_AUTH_URL', 'https://www.facebook.com/v12.0/dialog/oauth');\n";
    $config_content .= "define('FACEBOOK_TOKEN_URL', 'https://graph.facebook.com/v12.0/oauth/access_token');\n";
    $config_content .= "define('FACEBOOK_USERINFO_URL', 'https://graph.facebook.com/me');\n\n";
    
    $config_content .= "define('TWITTER_AUTH_URL', 'https://twitter.com/i/oauth2/authorize');\n";
    $config_content .= "define('TWITTER_TOKEN_URL', 'https://api.twitter.com/2/oauth2/token');\n";
    $config_content .= "define('TWITTER_USERINFO_URL', 'https://api.twitter.com/2/users/me');\n\n";
    
    $config_content .= "// State parameter for CSRF protection\n";
    $config_content .= "function generateState() {\n";
    $config_content .= "    return bin2hex(random_bytes(32));\n";
    $config_content .= "}\n\n";
    
    $config_content .= "// Store state in session for verification\n";
    $config_content .= "function storeState(\$state) {\n";
    $config_content .= "    \$_SESSION['oauth_state'] = \$state;\n";
    $config_content .= "}\n\n";
    
    $config_content .= "// Verify state parameter\n";
    $config_content .= "function verifyState(\$state) {\n";
    $config_content .= "    return isset(\$_SESSION['oauth_state']) && hash_equals(\$_SESSION['oauth_state'], \$state);\n";
    $config_content .= "}\n";
    $config_content .= "?>";
    
    if (file_put_contents('config/social_login.php', $config_content)) {
        $message = "Social login configuration updated successfully!";
    } else {
        $error = "Failed to write configuration file. Please check file permissions.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Social Login - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-cog me-2"></i>
                            Setup Social Login Configuration
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if ($message): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <h5 class="text-primary mb-3">
                                <i class="fab fa-google me-2"></i>
                                Google OAuth Configuration
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Google Client ID</label>
                                    <input type="text" name="google_client_id" class="form-control" placeholder="Enter Google Client ID" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Google Client Secret</label>
                                    <input type="password" name="google_client_secret" class="form-control" placeholder="Enter Google Client Secret" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Google Redirect URI</label>
                                <input type="url" name="google_redirect_uri" class="form-control" value="http://localhost/mental_health/social_callback.php?provider=google" required>
                                <small class="text-muted">Add this URL to your Google OAuth app's authorized redirect URIs</small>
                            </div>
                            
                            <h5 class="text-primary mb-3">
                                <i class="fab fa-facebook me-2"></i>
                                Facebook OAuth Configuration
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Facebook App ID</label>
                                    <input type="text" name="facebook_app_id" class="form-control" placeholder="Enter Facebook App ID" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Facebook App Secret</label>
                                    <input type="password" name="facebook_app_secret" class="form-control" placeholder="Enter Facebook App Secret" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Facebook Redirect URI</label>
                                <input type="url" name="facebook_redirect_uri" class="form-control" value="http://localhost/mental_health/social_callback.php?provider=facebook" required>
                                <small class="text-muted">Add this URL to your Facebook app's OAuth redirect URIs</small>
                            </div>
                            
                            <h5 class="text-primary mb-3">
                                <i class="fab fa-twitter me-2"></i>
                                Twitter OAuth Configuration
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Twitter Client ID</label>
                                    <input type="text" name="twitter_client_id" class="form-control" placeholder="Enter Twitter Client ID" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Twitter Client Secret</label>
                                    <input type="password" name="twitter_client_secret" class="form-control" placeholder="Enter Twitter Client Secret" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Twitter Redirect URI</label>
                                <input type="url" name="twitter_redirect_uri" class="form-control" value="http://localhost/mental_health/social_callback.php?provider=twitter" required>
                                <small class="text-muted">Add this URL to your Twitter app's OAuth redirect URIs</small>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>
                                    Save Configuration
                                </button>
                                <a href="admin/dashboard.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back to Dashboard
                                </a>
                            </div>
                        </form>
                        
                        <hr class="my-4">
                        
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Setup Instructions:</h6>
                            <ol class="mb-0">
                                <li>Create OAuth apps in Google, Facebook, and Twitter developer consoles</li>
                                <li>Get the Client ID and Client Secret from each provider</li>
                                <li>Add the redirect URIs to your OAuth app settings</li>
                                <li>Fill in the form above with your credentials</li>
                                <li>Save the configuration</li>
                                <li>Test the social login buttons on the login page</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 