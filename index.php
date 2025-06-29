<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Platform</title>
    
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
            box-shadow: var(--shadow);
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
            color: var(--text);
            text-decoration: none;
            border-bottom: 1px solid var(--light);
            font-size: 1.1rem;
        }
        .mobile-menu a:last-child {
            border-bottom: none;
        }
        .mobile-menu a:hover {
            background: var(--light);
            color: var(--primary);
            padding-left: 1.5rem;
        }
        .mobile-menu-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 2rem;
            color: var(--primary);
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
            .nav-links {
                display: none !important;
            }
            .mobile-menu-btn {
                display: block;
            }
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
        
        /* Responsive Footer */
        @media (max-width: 992px) {
            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
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
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.95) 0%, rgba(80, 227, 194, 0.95) 100%),
                        url('/assets/images/hero-bg.jpg') center/cover;
            padding: 120px 0;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/assets/images/pattern.png');
            opacity: 0.1;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        
        /* Features Section */
        .features {
            padding: 100px 0;
            background: var(--light);
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--text);
            margin-bottom: 3rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }
        
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .feature-card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .feature-card i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 1rem;
        }
        
        .feature-card p {
            color: var(--text-light);
            line-height: 1.6;
        }
        
        /* Testimonials Section */
        .testimonials {
            padding: 100px 0;
            background: var(--white);
        }
        
        .testimonial-slider {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .testimonial-card {
            background: var(--light);
            padding: 2rem;
            border-radius: 15px;
            margin: 1rem;
            box-shadow: var(--shadow);
        }
        
        .testimonial-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text);
            margin-bottom: 1.5rem;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .testimonial-author img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .testimonial-author h4 {
            color: var(--text);
            margin-bottom: 0.25rem;
        }
        
        .testimonial-author p {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        /* Resources Section */
        .resources {
            padding: 100px 0;
            background: var(--light);
        }
        
        .resource-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .resource-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .resource-content {
            padding: 1.5rem;
        }
        
        .resource-content h3 {
            font-size: 1.25rem;
            color: var(--text);
            margin-bottom: 0.75rem;
        }
        
        .resource-content p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }
        
        /* CTA Section */
        .cta {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/assets/images/pattern.png');
            opacity: 0.1;
        }
        
        .cta-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .cta p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        /* Buttons */
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
            background: var(--white);
            color: var(--primary);
        }
        
        .btn-primary:hover {
            background: var(--light);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }
        
        .btn-secondary:hover {
            background: var(--white);
            color: var(--primary);
            transform: translateY(-2px);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .nav-links {
                display: none !important;
            }
            .mobile-menu-btn {
                display: block;
            }
        }
        
        @media (max-width: 768px) {
            .hero {
                padding: 80px 0;
            }
            .hero h1 {
                font-size: 2.2rem;
            }
            .hero p {
                font-size: 1.1rem;
            }
            .section-title {
                font-size: 2rem;
            }
            .grid-3 {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
            }
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container nav-container">
            <div class="logo">
                <a href="index.php" class="logo-link">
                    <img src="images/logo.jpg" alt="Logo">
                    <span class="logo-text">NAYAS</span>
                </a>
            </div>
            
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="resources.php">Resources</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary">Login</a>
                    <a href="register.php" class="btn btn-secondary">Register</a>
                <?php endif; ?>
            </div>
            
            <button class="mobile-menu-btn" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
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
                <a href="/user/dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
    
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Your Journey to Better Mental Health Starts Here</h1>
                <p>Access professional support, resources, and tools to improve your mental well-being.</p>
                <div class="hero-buttons">
                    <a href="register.php" class="btn btn-primary">Get Started</a>
                    <a href="resources.php" class="btn btn-secondary">Learn More</a>
                </div>
            </div>
        </section>
        
        <section class="features">
            <div class="container">
                <h2 class="section-title">How We Can Help</h2>
                <div class="grid grid-3">
                    <div class="feature-card">
                        <i class="fas fa-user-md"></i>
                        <h3>Professional Support</h3>
                        <p>Connect with licensed therapists and mental health professionals.</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-chart-line"></i>
                        <h3>Mood Tracking</h3>
                        <p>Monitor your emotional well-being with our easy-to-use tools.</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-book"></i>
                        <h3>Resources</h3>
                        <p>Access articles, guides, and exercises for mental wellness.</p>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        <section class="resources">
            <div class="container">
                <h2 class="section-title">Latest Resources</h2>
                <div class="grid grid-3">
                    <article class="resource-card">
                        <img src="images/eye.jpg" alt="Understanding Anxiety">
                        <div class="resource-content">
                            <h3>Understanding Anxiety</h3>
                            <p>Learn about common anxiety triggers and coping strategies.</p>
                            <a href="resources.php" class="btn btn-primary">Read More</a>
                        </div>
                    </article>
                    <article class="resource-card">
                        <img src="images/brain.jpg" alt="Mindfulness Practices">
                        <div class="resource-content">
                            <h3>Mindfulness Practices</h3>
                            <p>Simple techniques to stay present and reduce stress.</p>
                            <a href="resources.php" class="btn btn-primary">Read More</a>
                        </div>
                    </article>
                    <article class="resource-card">
                        <img src="images/pic.jpg" alt="Building Resilience">
                        <div class="resource-content">
                            <h3>Building Resilience</h3>
                            <p>Develop the skills to bounce back from life's challenges.</p>
                            <a href="resources.php" class="btn btn-primary">Read More</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        
        <section class="cta">
            <div class="cta-content">
                <h2>Ready to Start Your Journey?</h2>
                <p>Join thousands of others who have taken the first step towards better mental health.</p>
                <a href="register.php" class="btn btn-primary">Sign Up Now</a>
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
    <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="LzcOTQKyp7FxsHUWSHndu";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html> 