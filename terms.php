<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Mental Health Platform</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-dark: #4338CA;
            --secondary-color: #10B981;
            --accent-color: #F59E0B;
            --danger-color: #EF4444;
            --text-primary: #1F2937;
            --text-secondary: #4B5563;
            --text-light: #9CA3AF;
            --bg-light: #F9FAFB;
            --bg-white: #FFFFFF;
            --border-color: #E5E7EB;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            color: var(--text-primary);
            background-color: var(--bg-light);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Logo Styles */
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

    
        /* Navbar Styles */
        .navbar {
            background: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 1rem 0;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        
        .logo-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 0.5px;
        }
        
        .logo img {
            height: 40px;
            transition: var(--transition);
        }
        
        .logo img:hover {
            transform: scale(1.05);
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        
        .nav-links a {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: var(--transition);
            position: relative;
        }
        
        .nav-links a:not(.btn)::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: var(--transition);
        }
        
        .nav-links a:not(.btn):hover {
            color: var(--primary);
        }
        
        .nav-links a:not(.btn):hover::after {
            width: 100%;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--primary);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: var(--transition);
        }
        
        .mobile-menu-btn:hover {
            transform: scale(1.1);
        }
        
        .mobile-menu {
            display: none;
            background: var(--white);
            padding: 1rem 0;
            box-shadow: var(--shadow);
        }
        
        .mobile-menu.active {
            display: block;
        }
        
        .mobile-menu a {
            display: block;
            padding: 1rem;
            color: var(--text);
            text-decoration: none;
            transition: var(--transition);
            border-bottom: 1px solid var(--light);
        }
        
        .mobile-menu a:hover {
            background: var(--light);
            color: var(--primary);
            padding-left: 1.5rem;
        }

        /* Terms Content */
        .terms-content {
            background-color: var(--bg-white);
            border-radius: 0.5rem;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: var(--shadow-md);
        }

        .terms-content h1 {
            font-size: 2rem;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
        }

        .terms-content h2 {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin: 2rem 0 1rem;
        }

        .terms-content p {
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .terms-content ul {
            list-style: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .terms-content li {
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        /* Footer */
        .footer {
            background-color: var(--bg-white);
            padding: 2rem 0;
            margin-top: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .footer-section h4 {
            font-size: 1rem;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .footer-section p {
            color: var(--text-secondary);
            font-size: 0.875rem;
            line-height: 1.6;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul li a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--primary-color);
        }

        .footer-bottom {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .grid-4 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container nav-container">
            <a href="index.php" class="navbar-brand d-flex align-items-center">
                <img src="images/logo.jpg" alt="Logo" class="img-fluid" style="height:40px; width:auto; margin-right:10px;">
                <span class="logo-text">NAYAS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto nav-links">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="resources.php">Resources</a>
                    <a class="nav-link" href="about.php">About</a>
                    <a class="nav-link" href="contact.php">Contact</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                        <a class="nav-link" href="logout.php">Logout</a>
                    <?php else: ?>
                        <a class="btn btn-primary ms-2" href="login.php">Login</a>
                        <a class="btn btn-secondary ms-2" href="register.php">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="mobile-menu">
        <div class="container">
            <a href="index.php">Home</a>
            <a href="resources.php">Resources</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="user/dashboard.php">Dashboard</a>
                <a href="auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="auth/login.php">Login</a>
                <a href="auth/register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <div class="terms-content">
            <h1>Terms of Service</h1>
            
            <p>Last updated: <?php echo date('F d, Y'); ?></p>
            
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing and using the Mental Health Platform ("Platform"), you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this Platform.</p>
            
            <h2>2. Use License</h2>
            <p>Permission is granted to temporarily access the Platform for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
            <ul>
                <li>Modify or copy the materials</li>
                <li>Use the materials for any commercial purpose</li>
                <li>Attempt to decompile or reverse engineer any software contained on the Platform</li>
                <li>Remove any copyright or other proprietary notations from the materials</li>
                <li>Transfer the materials to another person or "mirror" the materials on any other server</li>
            </ul>
            
            <h2>3. User Accounts</h2>
            <p>To access certain features of the Platform, you must register for an account. You agree to:</p>
            <ul>
                <li>Provide accurate and complete information</li>
                <li>Maintain the security of your account and password</li>
                <li>Accept responsibility for all activities that occur under your account</li>
                <li>Notify us immediately of any unauthorized use of your account</li>
            </ul>
            
            <h2>4. Privacy Policy</h2>
            <p>Your use of the Platform is also governed by our Privacy Policy. Please review our Privacy Policy, which also governs the Platform and informs users of our data collection practices.</p>
            
            <h2>5. Medical Disclaimer</h2>
            <p>The Platform is not a substitute for professional medical advice, diagnosis, or treatment. Always seek the advice of your physician or other qualified health provider with any questions you may have regarding a medical condition.</p>
            
            <h2>6. Limitation of Liability</h2>
            <p>In no event shall the Platform or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on the Platform.</p>
            
            <h2>7. Revisions and Errata</h2>
            <p>The materials appearing on the Platform could include technical, typographical, or photographic errors. We do not warrant that any of the materials on the Platform are accurate, complete, or current.</p>
            
            <h2>8. Links</h2>
            <p>We have not reviewed all of the sites linked to the Platform and are not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by us of the site.</p>
            
            <h2>9. Modifications</h2>
            <p>We may revise these terms of service at any time without notice. By using this Platform, you agree to be bound by the current version of these terms of service.</p>
            
            <h2>10. Governing Law</h2>
            <p>These terms and conditions are governed by and construed in accordance with the laws and you irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="grid-4">
                <div class="footer-section">
                    <h4>About Us</h4>
                    <p>Providing accessible mental health support and resources to help you on your journey to better mental wellbeing.</p>
                </div>
                
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="resources.php">Resources</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="resources.php#articles">Articles</a></li>
                        <li><a href="resources.php#guides">Guides</a></li>
                        <li><a href="resources.php#tools">Tools</a></li>
                        <li><a href="resources.php#videos">Videos</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="terms.php">Terms of Service</a></li>
                        <li><a href="cookies.php">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Mental Health Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Custom Scripts -->
    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('active');
        });
    </script>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
