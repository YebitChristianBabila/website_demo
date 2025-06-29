<?php
session_start();
require_once 'config/database.php';

$success_message = '';
$error_message = '';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    // Basic validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        try {
            // Insert contact message into database
            $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$name, $email, $subject, $message]);
            
            // Send email notification (optional)
            $to = "ndzengueantoinettelafortune@gmail.com";
            $email_subject = "New Contact Form Submission: " . $subject;
            $email_body = "Name: " . $name . "\n";
            $email_body .= "Email: " . $email . "\n";
            $email_body .= "Subject: " . $subject . "\n";
            $email_body .= "Message:\n" . $message . "\n";
            $email_body .= "\nSubmitted on: " . date('Y-m-d H:i:s');
            
            $headers = "From: " . $email . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            
            // Uncomment the line below to enable email sending
            // mail($to, $email_subject, $email_body, $headers);
            
            $success_message = "Thank you for your message! We'll get back to you soon.";
            
            // Clear form data after successful submission
            $name = $email = $subject = $message = '';
            
        } catch (PDOException $e) {
            $error_message = "Sorry, there was an error sending your message. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Mental Health Platform</title>
    
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
        
        /* Contact Page Styles */
        .contact-hero {
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.95) 0%, rgba(80, 227, 194, 0.95) 100%),
                        url('/assets/images/contact-bg.jpg') center/cover;
            padding: 80px 0;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .contact-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/assets/images/pattern.png');
            opacity: 0.1;
        }
        
        .contact-hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .contact-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .contact-hero p {
            font-size: 1.25rem;
            opacity: 0.9;
        }
        
        .contact-section {
            padding: 80px 0;
            background: var(--light);
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .contact-info {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
        }
        
        .contact-info h2 {
            font-size: 2rem;
            color: var(--text);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 1rem;
        }
        
        .contact-info h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary);
        }
        
        .contact-details {
            margin-top: 2rem;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .contact-item i {
            font-size: 1.5rem;
            color: var(--primary);
            width: 40px;
            height: 40px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .contact-item-content h3 {
            font-size: 1.1rem;
            color: var(--text);
            margin-bottom: 0.5rem;
        }
        
        .contact-item-content p {
            color: var(--text-light);
            line-height: 1.6;
        }
        
        .contact-form {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
        }
        
        .contact-form h2 {
            font-size: 2rem;
            color: var(--text);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 1rem;
        }
        
        .contact-form h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            color: var(--text);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #E1E1E1;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
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
        
        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }
        
        .btn-primary:hover {
            background: #357ABD;
            transform: translateY(-2px);
        }
        
        .map-section {
            padding: 80px 0;
            background: var(--white);
        }
        
        .map-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .map-frame {
            width: 100%;
            height: 400px;
            border-radius: 15px;
            box-shadow: var(--shadow);
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
            .contact-grid {
                grid-template-columns: 1fr;
            }
            
            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .contact-hero h1 {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .contact-hero {
                padding: 60px 0;
            }
            
            .contact-hero h1 {
                font-size: 2rem;
            }
            
            .contact-hero p {
                font-size: 1.1rem;
            }
            
            .contact-section {
                padding: 60px 0;
            }
            
            .contact-info, .contact-form {
                padding: 2rem;
            }
        }
        
        @media (max-width: 576px) {
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
            
            .contact-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
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
    <button class="mobile-menu-btn" aria-label="Toggle Menu" style="background:none;border:none;color:var(--primary-color,#4F46E5);font-size:1.5rem;cursor:pointer;padding:0.5rem;transition:all 0.3s;position:absolute;top:20px;right:20px;z-index:2003;"><i class="fas fa-bars"></i></button>
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
        <section class="contact-hero">
            <div class="contact-hero-content">
                <h1>Get in Touch</h1>
                <p>We're here to help and answer any questions you might have.</p>
            </div>
        </section>
        
        <section class="contact-section">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Contact Information</h2>
                    <p>Feel free to reach out to us through any of the following channels. We'll get back to you as soon as possible.</p>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="contact-item-content">
                                <h3>Our Location</h3>
                                <p>123 Mental Health Street<br>Wellness City, WC 12345</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div class="contact-item-content">
                                <h3>Phone Number</h3>
                                <p>+237 6 98 07 17 54<br>Mon-Fri, 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div class="contact-item-content">
                                <h3>Email Address</h3>
                                <p>ndzengueantoinettelafortune@gmail.com<br>support@mentalhealthplatform.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div class="contact-item-content">
                                <h3>Working Hours</h3>
                                <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h2>Send Us a Message</h2>
                    
                    <?php if ($success_message): ?>
                        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #c3e6cb;">
                            <?php echo htmlspecialchars($success_message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error_message): ?>
                        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #f5c6cb;">
                            <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" value="<?php echo isset($subject) ? htmlspecialchars($subject) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
                        </div>
                        
                        <button type="submit" name="contact_submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
        
        <section class="map-section">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15910.003964479836!2d11.502075!3d3.848032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x108bcf7b7b7b7b7b%3A0x7b7b7b7b7b7b7b7b!2sYaound%C3%A9%2C%20Cameroon!5e0!3m2!1sen!2s!4v1710000000000!5m2!1sen!2s" 
                    class="map-frame"
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
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
    <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="LzcOTQKyp7FxsHUWSHndu";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 