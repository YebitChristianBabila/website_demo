<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Mental Health Platform</title>
    
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
            color: var(--text-color, #333);
            text-decoration: none;
            border-bottom: 1px solid var(--light-bg, #f8f9fa);
            font-size: 1.1rem;
        }
        .mobile-menu a:last-child {
            border-bottom: none;
        }
        .mobile-menu a:hover {
            background: var(--light-bg, #f8f9fa);
            color: var(--primary-color, #4a90e2);
            padding-left: 1.5rem;
        }
        .mobile-menu-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 2rem;
            color: var(--primary-color, #4a90e2);
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

        /* About Page Specific Styles */
        .about-hero {
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.95) 0%, rgba(80, 227, 194, 0.95) 100%),
                        url('/assets/images/about-hero.jpg') center/cover;
            padding: 120px 0;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/assets/images/pattern.png');
            opacity: 0.1;
        }

        .about-hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .about-hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .about-hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .mission-section {
            padding: 100px 0;
            background: var(--white);
        }

        .mission-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .mission-text h2 {
            font-size: 2.5rem;
            color: var(--text);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .mission-text h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .mission-text p {
            color: var(--text-light);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .mission-image {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .mission-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .mission-image:hover img {
            transform: scale(1.05);
        }

        .values-section {
            padding: 100px 0;
            background: var(--light);
        }

        .values-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .value-card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .value-card i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .value-card h3 {
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .value-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        .team-section {
            padding: 100px 0;
            background: var(--white);
        }

        .team-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .team-member {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .team-member img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .team-member-info {
            padding: 1.5rem;
            text-align: center;
        }

        .team-member-info h3 {
            font-size: 1.25rem;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .team-member-info p {
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .team-member-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .team-member-social a {
            color: var(--text-light);
            font-size: 1.25rem;
            transition: var(--transition);
        }

        .team-member-social a:hover {
            color: var(--primary);
            transform: translateY(-3px);
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
            .mission-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .values-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .about-hero h1 {
                font-size: 2.5rem;
            }

            .mission-text h2 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .values-grid {
                grid-template-columns: 1fr;
            }

            .team-grid {
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
    <button class="mobile-menu-btn" aria-label="Toggle Menu" style="background:none;border:none;color:var(--primary-color,#4a90e2);font-size:1.5rem;cursor:pointer;padding:0.5rem;transition:all 0.3s;position:absolute;top:20px;right:20px;z-index:2003;"><i class="fas fa-bars"></i></button>
     
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
        <section class="about-hero">
            <div class="about-hero-content">
                <h1>Our Mission</h1>
                <p>Making mental health support accessible to everyone, everywhere.</p>
            </div>
        </section>
        
        <section class="mission-section">
            <div class="mission-content">
                <div class="mission-text">
                    <h2>Who We Are</h2>
                    <p>We are a team of mental health professionals, technologists, and advocates dedicated to breaking down barriers to mental health care. Our platform connects individuals with licensed therapists and provides valuable resources for mental well-being.</p>
                    <p>Founded in 2023, we've helped thousands of people access quality mental health support and resources, making a positive impact on communities worldwide.</p>
                </div>
                <div class="mission-image">
                    <img src="images/pic.jpg" alt="Our Mission">
                </div>
            </div>
        </section>
        
        <section class="values-section">
            <div class="container">
                <h2 class="section-title">Our Values</h2>
                <div class="values-grid">
                    <div class="value-card">
                        <i class="fas fa-heart"></i>
                        <h3>Compassion</h3>
                        <p>We approach every interaction with empathy and understanding, recognizing the unique journey of each individual.</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Trust</h3>
                        <p>We maintain the highest standards of confidentiality and security to build trust with our users.</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-lightbulb"></i>
                        <h3>Innovation</h3>
                        <p>We continuously evolve our platform to provide the best possible mental health support experience.</p>
                    </div>
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
    <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="LzcOTQKyp7FxsHUWSHndu";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 