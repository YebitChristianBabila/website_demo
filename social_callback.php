<?php
session_start();
require_once 'config/database.php';
require_once 'config/social_login.php';

$error = '';
$success = '';

if (isset($_GET['provider']) && isset($_GET['code'])) {
    $provider = $_GET['provider'];
    $code = $_GET['code'];
    $state = $_GET['state'] ?? '';
    // Log the received and session state to a file
    file_put_contents(__DIR__ . '/state_debug.log', date('Y-m-d H:i:s') . " | social_callback.php | Received state: $state | Session state: " . (isset($_SESSION['oauth_state']) ? $_SESSION['oauth_state'] : 'NOT SET') . "\n", FILE_APPEND);
    echo '<!-- DEBUG: Received state: ' . htmlspecialchars($state) . ' | Session state: ' . (isset($_SESSION['oauth_state']) ? htmlspecialchars($_SESSION['oauth_state']) : 'NOT SET') . ' -->';
    
    // Verify state parameter for CSRF protection
    if (!verifyState($state)) {
        $error = "Invalid state parameter. Please try again.";
    } else {
        try {
            switch ($provider) {
                case 'google':
                    $user_data = handleGoogleLogin($code);
                    break;
                case 'facebook':
                    $user_data = handleFacebookLogin($code);
                    break;
                case 'twitter':
                    $user_data = handleTwitterLogin($code);
                    break;
                default:
                    throw new Exception("Invalid provider");
            }
            
            if ($user_data) {
                // Check if user exists in database
                $stmt = $conn->prepare("SELECT id, username, email FROM users WHERE email = ? OR social_id = ?");
                $stmt->execute([$user_data['email'], $user_data['social_id']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user) {
                    // User exists, log them in
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    
                    header("Location: users/dashboard.php");
                    exit();
                } else {
                    // User doesn't exist, create new account
                    $stmt = $conn->prepare("INSERT INTO users (username, email, social_id, social_provider, created_at) VALUES (?, ?, ?, ?, NOW())");
                    $stmt->execute([
                        $user_data['username'],
                        $user_data['email'],
                        $user_data['social_id'],
                        $provider
                    ]);
                    
                    $user_id = $conn->lastInsertId();
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $user_data['username'];
                    $_SESSION['email'] = $user_data['email'];
                    
                    header("Location: users/dashboard.php");
                    exit();
                }
            }
        } catch (Exception $e) {
            $error = "Login failed: " . $e->getMessage();
        }
    }
} else {
    $error = "Invalid callback parameters";
}

// If we get here, there was an error
if ($error) {
    header("Location: login.php?error=" . urlencode($error));
    exit();
}

function handleGoogleLogin($code) {
    // Exchange code for access token
    $token_data = exchangeCodeForToken($code, 'google');
    
    if (isset($token_data['access_token'])) {
        // Get user info
        $user_info = getUserInfo($token_data['access_token'], 'google');
        return [
            'social_id' => $user_info['id'],
            'username' => $user_info['name'],
            'email' => $user_info['email'],
            'profile_picture' => $user_info['picture'] ?? null
        ];
    }
    return null;
}

function handleFacebookLogin($code) {
    // Exchange code for access token
    $token_data = exchangeCodeForToken($code, 'facebook');
    
    if (isset($token_data['access_token'])) {
        // Get user info
        $user_info = getUserInfo($token_data['access_token'], 'facebook');
        return [
            'social_id' => $user_info['id'],
            'username' => $user_info['name'],
            'email' => $user_info['email'] ?? null,
            'profile_picture' => $user_info['picture']['data']['url'] ?? null
        ];
    }
    return null;
}

function handleTwitterLogin($code) {
    // Exchange code for access token
    $token_data = exchangeCodeForToken($code, 'twitter');
    
    if (isset($token_data['access_token'])) {
        // Get user info
        $user_info = getUserInfo($token_data['access_token'], 'twitter');
        return [
            'social_id' => $user_info['data']['id'],
            'username' => $user_info['data']['username'],
            'email' => $user_info['data']['email'] ?? null,
            'profile_picture' => $user_info['data']['profile_image_url'] ?? null
        ];
    }
    return null;
}

function exchangeCodeForToken($code, $provider) {
    $ch = curl_init();
    
    switch ($provider) {
        case 'google':
            $url = GOOGLE_TOKEN_URL;
            $data = [
                'client_id' => GOOGLE_CLIENT_ID,
                'client_secret' => GOOGLE_CLIENT_SECRET,
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => GOOGLE_REDIRECT_URI
            ];
            break;
        case 'facebook':
            $url = FACEBOOK_TOKEN_URL;
            $data = [
                'client_id' => FACEBOOK_APP_ID,
                'client_secret' => FACEBOOK_APP_SECRET,
                'code' => $code,
                'redirect_uri' => FACEBOOK_REDIRECT_URI
            ];
            break;
        case 'twitter':
            $url = TWITTER_TOKEN_URL;
            $data = [
                'client_id' => TWITTER_CLIENT_ID,
                'client_secret' => TWITTER_CLIENT_SECRET,
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => TWITTER_REDIRECT_URI,
                'code_verifier' => $_SESSION['code_verifier'] ?? ''
            ];
            break;
    }
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}

function getUserInfo($access_token, $provider) {
    $ch = curl_init();
    
    switch ($provider) {
        case 'google':
            $url = GOOGLE_USERINFO_URL . '?access_token=' . $access_token;
            break;
        case 'facebook':
            $url = FACEBOOK_USERINFO_URL . '?access_token=' . $access_token . '&fields=id,name,email,picture';
            break;
        case 'twitter':
            $url = TWITTER_USERINFO_URL;
            $headers = ['Authorization: Bearer ' . $access_token];
            break;
    }
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    if ($provider === 'twitter') {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}
?> 