<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Mental Health Platform</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4A90E2;
            --secondary: #50E3C2;
            --accent: #F5A623;
            --text: #2C3E50;
            --text-light: #7F8C8D;
            --light: #F5F6FA;
            --white: #FFFFFF;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        body { background: var(--light); font-family: 'Inter', sans-serif; }
        .navbar { background: var(--white); box-shadow: var(--shadow); position: sticky; top: 0; z-index: 1000; padding: 1rem 0; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .logo-text { font-size: 1.5rem; font-weight: 700; color: var(--primary); letter-spacing: 0.5px; }
        .logo img { height: 40px; transition: var(--transition); }
        .nav-links { display: flex; align-items: center; gap: 2rem; }
        .nav-links a { color: var(--text); text-decoration: none; font-weight: 500; font-size: 1rem; transition: var(--transition); position: relative; }
        .nav-links a:not(.btn)::after { content: ''; position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: var(--primary); transition: var(--transition); }
        .nav-links a:not(.btn):hover { color: var(--primary); }
        .nav-links a:not(.btn):hover::after { width: 100%; }
        .mobile-menu-btn { display: none; background: none; border: none; color: var(--primary); font-size: 1.5rem; cursor: pointer; padding: 0.5rem; transition: var(--transition); }
        .mobile-menu-btn:hover { transform: scale(1.1); }
        .mobile-menu { position: fixed; top: 0; left: 0; height: 100vh; width: 80vw; max-width: 350px; background: var(--white); box-shadow: var(--shadow); padding: 2rem 1.5rem 1.5rem 1.5rem; z-index: 2001; transform: translateX(-100%); transition: transform 0.3s cubic-bezier(.4,0,.2,1); display: block; }
        .mobile-menu.active { transform: translateX(0); }
        .mobile-menu a { display: block; padding: 1rem 0; color: var(--text); text-decoration: none; border-bottom: 1px solid var(--light); font-size: 1.1rem; }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu a:hover { background: var(--light); color: var(--primary); padding-left: 1.5rem; }
        .mobile-menu-close { position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 2rem; color: var(--primary); z-index: 2002; }
        .mobile-menu-overlay { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.3); z-index: 2000; display: none; }
        .mobile-menu-overlay.active { display: block; }
        @media (min-width: 993px) { .mobile-menu, .mobile-menu-overlay, .mobile-menu-btn { display: none !important; } }
        @media (max-width: 992px) { .nav-links { display: none !important; } .mobile-menu-btn { display: block; } }
        .privacy-section { background: var(--white); max-width: 900px; margin: 3rem auto; border-radius: 16px; box-shadow: var(--shadow); padding: 2.5rem 2rem; }
        .privacy-section h1 { font-size: 2.5rem; color: var(--primary); margin-bottom: 1.5rem; }
        .privacy-section h2 { font-size: 1.5rem; color: var(--text); margin-top: 2rem; margin-bottom: 1rem; }
        .privacy-section p, .privacy-section ul { color: var(--text-light); font-size: 1.1rem; line-height: 1.7; }
        .privacy-section ul { margin-bottom: 1.5rem; }
        .footer { background: var(--text); color: var(--white); padding: 4rem 0 2rem; margin-top: 4rem; }
        .footer .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; margin-bottom: 3rem; }
        .footer-section h4 { color: var(--white); font-size: 1.25rem; margin-bottom: 1.5rem; position: relative; padding-bottom: 0.75rem; }
        .footer-section h4::after { content: ''; position: absolute; bottom: 0; left: 0; width: 50px; height: 2px; background: var(--primary); }
        .footer-section p { color: rgba(255, 255, 255, 0.8); line-height: 1.6; margin-bottom: 1rem; }
        .footer-section ul { list-style: none; padding: 0; margin: 0; }
        .footer-section ul li { margin-bottom: 0.75rem; }
        .footer-section ul li a { color: rgba(255, 255, 255, 0.8); text-decoration: none; transition: var(--transition); display: inline-block; }
        .footer-section ul li a:hover { color: var(--primary); transform: translateX(5px); }
        .emergency-number { font-size: 1.5rem; font-weight: 600; color: var(--accent); margin: 0.5rem 0 1rem; }
        .social-links { display: flex; gap: 1rem; }
        .social-links a { color: var(--white); font-size: 1.5rem; transition: var(--transition); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255, 255, 255, 0.1); }
        .social-links a:hover { background: var(--primary); transform: translateY(-3px); }
        .footer-bottom { text-align: center; padding-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.1); }
        .footer-bottom p { color: rgba(255, 255, 255, 0.6); font-size: 0.9rem; }
        @media (max-width: 992px) { .grid-4 { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 576px) { .grid-4 { grid-template-columns: 1fr; } .footer-section { text-align: center; } .footer-section h4::after { left: 50%; transform: translateX(-50%); } .social-links { justify-content: center; } .privacy-section { padding: 1.5rem 0.5rem; } }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container nav-container">
    <a href="index.php" class="navbar-brand d-flex align-items-center">
      <img src="images/logo.jpg" alt="Logo" class="img-fluid" style="height:40px; width:auto; margin-right:10px;">
      <span class="logo-text">NAYAS</span>
    </a>
    <button class="mobile-menu-btn" aria-label="Toggle Menu" style="background:none;border:none;color:var(--primary,#4A90E2);font-size:1.5rem;cursor:pointer;padding:0.5rem;transition:all 0.3s;position:absolute;top:20px;right:20px;z-index:2003;"><i class="fas fa-bars"></i></button>
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
<div class="mobile-menu-overlay"></div>
<div class="mobile-menu">
    <button class="mobile-menu-close" aria-label="Close Menu">&times;</button>
    <div class="container">
        <a href="index.php">Home</a>
        <a href="resources.php">Resources</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</div>
<main>
    <section class="privacy-section">
        <h1>Privacy Policy</h1>
        <p>Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our Mental Health Platform.</p>
        <h2>Information We Collect</h2>
        <ul>
            <li>Personal identification information (Name, email address, phone number, etc.)</li>
            <li>Health and wellness data you provide</li>
            <li>Usage data and cookies</li>
        </ul>
        <h2>How We Use Your Information</h2>
        <ul>
            <li>To provide and maintain our services</li>
            <li>To personalize your experience</li>
            <li>To improve our platform and services</li>
            <li>To communicate with you about updates, offers, and support</li>
            <li>To comply with legal obligations</li>
        </ul>
        <h2>How We Protect Your Information</h2>
        <p>We use administrative, technical, and physical security measures to help protect your personal information. While we strive to use commercially acceptable means to protect your information, no method of transmission over the Internet or method of electronic storage is 100% secure.</p>
        <h2>Sharing Your Information</h2>
        <p>We do not sell, trade, or rent your personal information to third parties. We may share information with trusted partners who assist us in operating our platform, conducting our business, or serving our users, so long as those parties agree to keep this information confidential.</p>
        <h2>Your Rights</h2>
        <ul>
            <li>Access, update, or delete your personal information</li>
            <li>Opt-out of receiving communications from us</li>
            <li>Request a copy of the information we hold about you</li>
        </ul>
        <h2>Children's Privacy</h2>
        <p>Our platform is not intended for children under the age of 13. We do not knowingly collect personal information from children under 13. If you believe we have collected such information, please contact us immediately.</p>
        <h2>Changes to This Policy</h2>
        <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. Changes are effective when they are posted.</p>
        <h2>Contact Us</h2>
        <p>If you have any questions about this Privacy Policy, please contact us at <a href="mailto:support@mentalhealthplatform.com">support@mentalhealthplatform.com</a>.</p>
    </section>
</main>
<footer class="footer">
    <div class="container">
        <div class="grid grid-4">
            <div class="footer-section">
                <h4>About Us</h4>
                <p>Providing accessible mental health support and resources for everyone.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="resources.php">Resources</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="privacy-policy.php">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Emergency</h4>
                <p>If you're in crisis, please call:</p>
                <p class="emergency-number">+237698071754</p>
                <a href="emergency.php" class="btn btn-accent">Emergency Resources</a>
            </div>
            <div class="footer-section">
                <h4>Connect With Us</h4>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Mental Health Platform. All rights reserved.</p>
        </div>
    </div>
</footer>
<!-- Bootstrap 5.3 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mobile menu toggle
    const menuBtn = document.querySelector('.mobile-menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileOverlay = document.querySelector('.mobile-menu-overlay');
    const closeBtn = document.querySelector('.mobile-menu-close');
    menuBtn.addEventListener('click', function() {
        mobileMenu.classList.add('active');
        mobileOverlay.classList.add('active');
    });
    closeBtn.addEventListener('click', function() {
        mobileMenu.classList.remove('active');
        mobileOverlay.classList.remove('active');
    });
    mobileOverlay.addEventListener('click', function() {
        mobileMenu.classList.remove('active');
        mobileOverlay.classList.remove('active');
    });
</script>
</body>
</html> 