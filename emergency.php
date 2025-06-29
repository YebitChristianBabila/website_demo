<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Resources - Mental Health Platform</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    
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
            --danger: #E74C3C;
            --text: #2C3E50;
            --text-light: #7F8C8D;
            --light: #F5F6FA;
            --white: #FFFFFF;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
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
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 80vw;
            max-width: 350px;
            background: var(--white);
            box-shadow: var(--shadow-sm, 0 1px 2px 0 rgba(0,0,0,0.05));
            padding: 2rem 1.5rem 1.5rem 1.5rem;
            z-index: 2001;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            display: block;
        }
        .mobile-menu.active {
            transform: translateX(0);
        }
        .mobile-menu a {
            display: block;
            padding: 1rem 0;
            color: var(--text-primary, #1F2937);
            text-decoration: none;
            border-bottom: 1px solid var(--border-color, #E5E7EB);
            font-size: 1.1rem;
        }
        .mobile-menu a:last-child {
            border-bottom: none;
        }
        .mobile-menu a:hover {
            background: var(--bg-light, #F9FAFB);
            color: var(--primary-color, #4F46E5);
            padding-left: 1.5rem;
        }
        .mobile-menu-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 2rem;
            color: var(--primary-color, #4F46E5);
            z-index: 2002;
        }
        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.3);
            z-index: 2000;
            display: none;
        }
        .mobile-menu-overlay.active {
            display: block;
        }
        @media (min-width: 993px) {
            .mobile-menu, .mobile-menu-overlay, .mobile-menu-btn { display: none !important; }
        }
        @media (max-width: 992px) {
            .navbar-nav.nav-links {
                display: none !important;
            }
            .mobile-menu-btn {
                display: block;
            }
        }
        
        /* Emergency Page Styles */
        .emergency-hero {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.95) 0%, rgba(192, 57, 43, 0.95) 100%),
                        url('/assets/images/emergency-bg.jpg') center/cover;
            padding: 80px 0;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .emergency-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/assets/images/pattern.png');
            opacity: 0.1;
        }
        
        .emergency-hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .emergency-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .emergency-hero p {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .emergency-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--white);
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem 2rem;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 1rem;
            transition: var(--transition);
        }
        
        .emergency-number:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }
        
        .emergency-section {
            padding: 80px 0;
            background: var(--light);
        }
        
        .emergency-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .emergency-card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
        }
        
        .emergency-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .emergency-card i {
            font-size: 3rem;
            color: var(--danger);
            margin-bottom: 1.5rem;
        }
        
        .emergency-card h3 {
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 1rem;
        }
        
        .emergency-card p {
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .resources-section {
            padding: 80px 0;
            background: var(--white);
        }
        
        .resources-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .resource-card {
            background: var(--light);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
        }
        
        .resource-card h3 {
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 0.75rem;
        }
        
        .resource-card h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--danger);
        }
        
        .resource-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .resource-card ul li {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
            position: relative;
        }
        
        .resource-card ul li::before {
            content: '•';
            color: var(--danger);
            position: absolute;
            left: 0;
            font-size: 1.5rem;
            line-height: 1;
        }
        
        .resource-card ul li a {
            color: var(--text);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .resource-card ul li a:hover {
            color: var(--danger);
        }
        
        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }
        
        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }
        
        .btn-danger:hover {
            background: #C0392B;
            transform: translateY(-2px);
        }
        
        /* Footer Styles */
        .footer {
            background: var(--text);
            color: var(--white);
            padding: 4rem 0 2rem;
        }
        
        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .footer-section h4 {
            color: var(--white);
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
        }
        
        .footer-section h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary);
        }
        
        .footer-section p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-section ul li {
            margin-bottom: 0.75rem;
        }
        
        .footer-section ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
        }
        
        .footer-section ul li a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }
        
        .emergency-number {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--accent);
            margin: 0.5rem 0 1rem;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .social-links a {
            color: var(--white);
            font-size: 1.5rem;
            transition: var(--transition);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .footer-bottom p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .emergency-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .resources-grid {
                grid-template-columns: 1fr;
            }
            
            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .emergency-hero h1 {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .emergency-hero {
                padding: 60px 0;
            }
            
            .emergency-hero h1 {
                font-size: 2rem;
            }
            
            .emergency-hero p {
                font-size: 1.1rem;
            }
            
            .emergency-section {
                padding: 60px 0;
            }
            
            .emergency-card {
                padding: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .emergency-grid {
                grid-template-columns: 1fr;
            }
            
            .grid-4 {
                grid-template-columns: 1fr;
            }
            
            .footer-section {
                text-align: center;
            }
            
            .footer-section h4::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .social-links {
                justify-content: center;
            }
            
            .emergency-number {
                font-size: 2rem;
            }
        }

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
     color: var(--primary-color, #4F46E5);
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
    
    <button class="mobile-menu-btn" aria-label="Toggle Menu" style="display:none;background:none;border:none;color:var(--primary-color,#4F46E5);font-size:1.5rem;cursor:pointer;padding:0.5rem;transition:all 0.3s;position:absolute;top:20px;right:20px;z-index:2003;"><i class="fas fa-bars"></i></button>
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
        <section class="emergency-hero">
            <div class="emergency-hero-content">
                <h1>Emergency Support Available 24/7</h1>
                <p>If you're experiencing a mental health crisis, help is just a call away.</p>
                <a href="tel:1-800-273-8255" class="emergency-number">+237698071754</a>
                <p>National Suicide Prevention Lifeline</p>
            </div>
        </section>
        
        <section class="emergency-section">
            <div class="emergency-grid">
                <div class="emergency-card">
                    <i class="fas fa-phone-alt"></i>
                    <h3>24/7 Crisis Hotline</h3>
                    <p>Speak with trained crisis counselors who can provide immediate support and guidance.</p>
                    <a href="tel:1-800-273-8255" class="btn btn-danger">Call Now</a>
                </div>
                
                <div class="emergency-card">
                    <i class="fas fa-comments"></i>
                    <h3>Crisis Text Line</h3>
                    <p>Text HOME to 741741 to connect with a Crisis Counselor. Available 24/7.</p>
                    <a href="sms:741741&body=HOME" class="btn btn-danger">Text Now</a>
                </div>
                
                <div class="emergency-card">
                    <i class="fas fa-hospital"></i>
                    <h3>Emergency Services</h3>
                    <p>If you're in immediate danger, call 911 or go to your nearest emergency room.</p>
                    <a href="tel:911" class="btn btn-danger">Call 911</a>
                </div>
            </div>
        </section>
        
        <section class="resources-section">
            <div class="resources-grid">
                <div class="resource-card">
                    <h3>Additional Crisis Resources</h3>
                    <ul>
                        <li><a href="https://www.samhsa.gov/find-help/national-helpline" target="_blank">SAMHSA's National Helpline</a> - 1-800-662-4357</li>
                        <li><a href="https://www.thetrevorproject.org/" target="_blank">The Trevor Project</a> - 1-866-488-7386</li>
                        <li><a href="https://www.veteranscrisisline.net/" target="_blank">Veterans Crisis Line</a> - 1-800-273-8255</li>
                        <li><a href="https://www.nami.org/help" target="_blank">NAMI Helpline</a> - 1-800-950-6264</li>
                    </ul>
                </div>
                
                <div class="resource-card">
                    <h3>Immediate Support Options</h3>
                    <ul>
                        <li><a href="https://www.crisistextline.org/" target="_blank">Crisis Text Line</a> - Text HOME to 741741</li>
                        <li><a href="https://www.imalive.org/" target="_blank">IMAlive</a> - Online crisis chat</li>
                        <li><a href="https://www.suicidepreventionlifeline.org/chat/" target="_blank">Lifeline Chat</a> - Online crisis chat</li>
                        <li><a href="https://www.translifeline.org/" target="_blank">Trans Lifeline</a> - 1-877-565-8860</li>
                    </ul>
                </div>
            </div>
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
    
    <!-- JavaScript -->
    <script src="/assets/js/main.js"></script>
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
    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 