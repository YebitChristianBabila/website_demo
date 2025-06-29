<?php
require_once 'config.php';

// Get search term from GET
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Prepare SQL
if ($search !== '') {
    $stmt = $conn->prepare("SELECT * FROM resources WHERE status = 'active' AND (title LIKE ? OR description LIKE ?) ORDER BY created_at DESC");
    $like = "%$search%";
    $stmt->bind_param("ss", $like, $like);
} else {
    $stmt = $conn->prepare("SELECT * FROM resources WHERE status = 'active' ORDER BY created_at DESC");
}
$stmt->execute();
$result = $stmt->get_result();
$resources = $result->fetch_all(MYSQLI_ASSOC);

// Fallback images for variety
$fallback_images = [
    'images/pic.jpg',
    'images/brain.jpg',
    'images/eye.jpg',
    'images/think.jpg',
    'images/boy.jpg',
    'images/text.jpg',
    'images/no.jpg',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Resources - Mental Health Platform</title>
    
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
            box-shadow: var(--shadow, 0 4px 6px rgba(0,0,0,0.1));
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
            color: var(--text, #2C3E50);
            text-decoration: none;
            border-bottom: 1px solid var(--light, #F5F6FA);
            font-size: 1.1rem;
        }
        .mobile-menu a:last-child {
            border-bottom: none;
        }
        .mobile-menu a:hover {
            background: var(--light, #F5F6FA);
            color: var(--primary, #4A90E2);
            padding-left: 1.5rem;
        }
        .mobile-menu-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 2rem;
            color: var(--primary, #4A90E2);
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
        
        /* Resources Page Styles */
        .resources-hero {
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.95) 0%, rgba(80, 227, 194, 0.95) 100%),
                        url('/assets/images/resources-bg.jpg') center/cover;
            padding: 80px 0;
            text-align: center;
            color: var(--white);
            position: relative;
        }
        
        .resources-hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .resources-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .resources-hero p {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .search-bar {
            max-width: 600px;
            margin: 2rem auto 0;
            position: relative;
        }
        
        .search-bar input {
            width: 100%;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            box-shadow: var(--shadow);
        }
        
        .search-bar button {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--primary);
            font-size: 1.25rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .search-bar button:hover {
            transform: translateY(-50%) scale(1.1);
        }
        
        .resources-section {
            padding: 80px 0;
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
        
        .category-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }
        
        .category-tab {
            padding: 0.75rem 1.5rem;
            background: var(--white);
            border-radius: 50px;
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }
        
        .category-tab:hover,
        .category-tab.active {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .resources-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 1rem;
        }
        
        .resource-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .resource-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .resource-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .resource-content {
            padding: 1.5rem;
        }
        
        .resource-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--light);
            color: var(--primary);
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }
        
        .resource-content h3 {
            font-size: 1.25rem;
            color: var(--text);
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }
        
        .resource-content p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .resource-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }
        
        .resource-meta i {
            color: var(--primary);
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
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 3rem;
        }
        
        .pagination a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--white);
            color: var(--text);
            text-decoration: none;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }
        
        .pagination a:hover,
        .pagination a.active {
            background: var(--primary);
            color: var(--white);
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
            .resources-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .resources-hero h1 {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .resources-hero {
                padding: 60px 0;
            }
            
            .resources-hero h1 {
                font-size: 2rem;
            }
            
            .resources-hero p {
                font-size: 1.1rem;
            }
            
            .resources-section {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .category-tabs {
                gap: 0.5rem;
            }
            
            .category-tab {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 576px) {
            .resources-grid {
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
            
            .search-bar input {
                font-size: 1rem;
                padding: 0.75rem 1rem;
                padding-right: 3rem;
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
        <section class="resources-hero">
            <div class="resources-hero-content">
                <h1>Mental Health Resources</h1>
                <p>Discover articles, guides, and tools to support your mental well-being journey.</p>
                <div class="search-bar">
                    <form method="get" action="resources.php" class="d-flex">
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search resources..." class="form-control me-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </section>
        
        <section class="resources-section">
            <div class="container">
                <h2 class="section-title">Browse Resources</h2>
                
                <div class="category-tabs">
                    <a href="#" class="category-tab active">All</a>
                    <a href="#" class="category-tab">Articles</a>
                    <a href="#" class="category-tab">Guides</a>
                    <a href="#" class="category-tab">Videos</a>
                    <a href="#" class="category-tab">Tools</a>
                    <a href="#" class="category-tab">Worksheets</a>
                </div>
                
                <div class="resources-grid">
                    <?php if (empty($resources)): ?>
                        <div class="col-12 text-center text-muted">No resources found.</div>
                    <?php else: ?>
                        <?php foreach ($resources as $i => $resource): ?>
                        <article class="resource-card">
                            <?php 
                            $img = null;
                            if (!empty($resource['file_path'])) {
                                $img = $resource['file_path'];
                                // Remove leading ../ if present
                                if (strpos($img, '../') === 0) {
                                    $img = substr($img, 3);
                                }
                            } elseif (!empty($resource['image'])) {
                                $img = $resource['image'];
                            } else {
                                $img = $fallback_images[$i % count($fallback_images)];
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($resource['title']); ?>" class="resource-image">
                            <div class="resource-content">
                                <span class="resource-category"><?php echo htmlspecialchars(ucfirst($resource['category'])); ?></span>
                                <h3><?php echo htmlspecialchars($resource['title']); ?></h3>
                                <p><?php echo htmlspecialchars($resource['description']); ?></p>
                                <div class="resource-meta">
                                    <span><i class="far fa-calendar"></i> <?php echo date('M d, Y', strtotime($resource['created_at'])); ?></span>
                                </div>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="pagination">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fas fa-chevron-right"></i></a>
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
    <script src="main.js"></script>
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
        
        // Category tabs
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
    <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="LzcOTQKyp7FxsHUWSHndu";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 