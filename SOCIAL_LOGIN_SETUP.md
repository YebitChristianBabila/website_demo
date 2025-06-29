# Social Media Login Setup Guide

This guide will help you set up social media login functionality for Google, Facebook, and Twitter in your mental health platform.

## 🚀 Quick Setup

### 1. Database Setup
First, run the SQL command to add social login columns to your users table:

```sql
-- Run this in your database
ALTER TABLE `users` 
ADD COLUMN `social_id` VARCHAR(255) NULL AFTER `email`,
ADD COLUMN `social_provider` ENUM('google', 'facebook', 'twitter') NULL AFTER `social_id`,
ADD COLUMN `profile_picture` VARCHAR(255) NULL AFTER `social_provider`,
ADD INDEX `idx_social_login` (`social_id`, `social_provider`),
ADD INDEX `idx_email` (`email`);
```

### 2. OAuth App Registration

#### Google OAuth Setup
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable Google+ API
4. Go to "Credentials" → "Create Credentials" → "OAuth 2.0 Client IDs"
5. Set Application Type to "Web application"
6. Add authorized redirect URIs:
   - `http://localhost/mental_health/social_callback.php?provider=google`
   - `https://yourdomain.com/mental_health/social_callback.php?provider=google`
7. Copy Client ID and Client Secret

#### Facebook OAuth Setup
1. Go to [Facebook Developers](https://developers.facebook.com/)
2. Create a new app
3. Add Facebook Login product
4. Go to "Facebook Login" → "Settings"
5. Add Valid OAuth Redirect URIs:
   - `http://localhost/mental_health/social_callback.php?provider=facebook`
   - `https://yourdomain.com/mental_health/social_callback.php?provider=facebook`
6. Copy App ID and App Secret

#### Twitter OAuth Setup
1. Go to [Twitter Developer Portal](https://developer.twitter.com/)
2. Create a new app
3. Enable OAuth 2.0
4. Add Callback URLs:
   - `http://localhost/mental_health/social_callback.php?provider=twitter`
   - `https://yourdomain.com/mental_health/social_callback.php?provider=twitter`
5. Copy Client ID and Client Secret

### 3. Configuration Setup

#### Option A: Use the Setup Script (Recommended)
1. Log in as admin
2. Visit: `http://localhost/mental_health/setup_social_login.php`
3. Fill in your OAuth credentials
4. Click "Save Configuration"

#### Option B: Manual Configuration
Edit `config/social_login.php` and replace the placeholder values:

```php
// Google OAuth Configuration
define('GOOGLE_CLIENT_ID', 'your_actual_google_client_id');
define('GOOGLE_CLIENT_SECRET', 'your_actual_google_client_secret');
define('GOOGLE_REDIRECT_URI', 'http://localhost/mental_health/social_callback.php?provider=google');

// Facebook OAuth Configuration
define('FACEBOOK_APP_ID', 'your_actual_facebook_app_id');
define('FACEBOOK_APP_SECRET', 'your_actual_facebook_app_secret');
define('FACEBOOK_REDIRECT_URI', 'http://localhost/mental_health/social_callback.php?provider=facebook');

// Twitter OAuth Configuration
define('TWITTER_CLIENT_ID', 'your_actual_twitter_client_id');
define('TWITTER_CLIENT_SECRET', 'your_actual_twitter_client_secret');
define('TWITTER_REDIRECT_URI', 'http://localhost/mental_health/social_callback.php?provider=twitter');
```

## 🔧 Features Implemented

### ✅ What's Working
- **Google OAuth 2.0 Login**: Full implementation with user profile data
- **Facebook OAuth 2.0 Login**: Complete integration with profile picture
- **Twitter OAuth 2.0 Login**: Modern OAuth 2.0 implementation
- **Automatic Account Creation**: New users are created automatically
- **Existing User Login**: Users can log in with existing accounts
- **CSRF Protection**: State parameter verification
- **Error Handling**: Comprehensive error messages
- **Database Integration**: Proper user data storage

### 🔒 Security Features
- **State Parameter**: CSRF protection for all OAuth flows
- **Input Validation**: All user data is validated and sanitized
- **Secure Token Exchange**: HTTPS-only token requests
- **Session Management**: Proper session handling
- **SQL Injection Protection**: Prepared statements throughout

## 📁 Files Created/Modified

### New Files
- `config/social_login.php` - OAuth configuration
- `social_callback.php` - OAuth callback handler
- `setup_social_login.php` - Admin setup interface
- `database/add_social_login_columns.sql` - Database schema
- `SOCIAL_LOGIN_SETUP.md` - This setup guide

### Modified Files
- `login.php` - Added social login buttons and OAuth URL generation

## 🧪 Testing

### Test the Implementation
1. Visit your login page: `http://localhost/mental_health/login.php`
2. Click on any social login button
3. Complete the OAuth flow
4. Verify user is logged in and redirected to dashboard
5. Check database for new user record

### Common Issues & Solutions

#### "Invalid redirect URI" Error
- Ensure redirect URIs match exactly in your OAuth app settings
- Check for trailing slashes or protocol mismatches

#### "Client ID not found" Error
- Verify your OAuth credentials are correct
- Check that the app is published/approved

#### "State parameter invalid" Error
- Clear browser cookies and try again
- Check session configuration

#### Database Connection Issues
- Ensure the users table has the required columns
- Run the SQL setup script if needed

## 🌐 Production Deployment

### Update URLs for Production
When deploying to production, update all redirect URIs:

1. **OAuth App Settings**: Update redirect URIs in Google/Facebook/Twitter developer consoles
2. **Configuration File**: Update redirect URIs in `config/social_login.php`
3. **Domain**: Replace `localhost` with your actual domain

### Security Considerations
- Use HTTPS in production
- Store OAuth secrets securely
- Regularly rotate OAuth credentials
- Monitor OAuth usage and errors
- Implement rate limiting if needed

## 📞 Support

If you encounter issues:
1. Check the error messages in the login page
2. Verify OAuth app settings
3. Check database connectivity
4. Review server error logs
5. Ensure all required PHP extensions are enabled (curl, json, openssl)

## 🎯 Next Steps

After successful setup:
1. Customize the user registration flow
2. Add profile picture upload functionality
3. Implement email verification for social users
4. Add social login analytics
5. Consider implementing social sharing features

---

**Note**: This implementation uses OAuth 2.0 for all providers, which is the current standard and most secure approach for social login integration. 