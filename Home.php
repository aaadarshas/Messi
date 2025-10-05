<?php    
session_start();    
    
// Logout handling    
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['logout'])) {    
    session_unset();    
    session_destroy();    
    header("Location: index.php");    
    exit();    
}    
?>    
<!DOCTYPE html>    
<html lang="en">    
<head>    
  <meta charset="UTF-8" />    
  <meta name="viewport" content="width=device-width, initial-scale=1" />    
  <title>BookNest HOME - Online Book Stall</title>    
    
  <!-- Google Fonts -->    
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />    
    
  <!-- AOS Animation -->    
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />    
    
  <!-- FontAwesome for social icons -->    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />    
    
  <style>    
    * { margin: 0; padding: 0; box-sizing: border-box; }    
    html, body {    
      font-family: 'Poppins', sans-serif;    
      width: 100%;    
      overflow-x: hidden;    
      background-color: #fdf6ec;    
      scroll-behavior: smooth;    
    }    
    /* Header */    
    header {    
      background-color: #8b4513;    
      padding: 1rem 2rem;    
      color: white;    
      position: sticky;    
      top: 0;    
      z-index: 1000;    
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);    
    }    
    .header-container {    
      display: flex;    
      align-items: center;    
      justify-content: space-between;    
      max-width: 1200px;    
      margin: 0 auto;    
    }    
    .logo span {    
      font-size: 2rem;    
      font-weight: 600;    
      animation: slideIn 1s ease-out forwards;    
    }    
    .welcome-container { display: flex; align-items: center; gap: 15px; }    
    .welcome-message { font-size: 1.1rem; color: white; }    
    .logout-btn {    
      background: rgba(255, 255, 255, 0.2);    
      color: white;    
      border: none;    
      padding: 8px 15px;    
      border-radius: 4px;    
      cursor: pointer;    
      transition: background 0.3s;    
      font-family: 'Poppins', sans-serif;    
    }    
    .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }    
    @keyframes slideIn { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }    
    
    /* Floating Icons Container */    
    .floating-icons {    
      position: fixed;    
      top: 20px;    
      right: 20px;    
      display: flex;    
      gap: 15px;    
      z-index: 999;    
    }    
    .floating-icons div {    
      background: white;    
      width: 50px;    
      height: 50px;    
      border-radius: 50%;    
      display: flex;    
      align-items: center;    
      justify-content: center;    
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);    
      transition: transform 0.3s ease;    
    }    
    .floating-icons div img {    
      width: 28px;    
      height: 28px;    
    }    
    .floating-icons div:hover { transform: scale(1.1); }    
    
    /* Banner */    
    .banner {    
      height: 100vh;    
      background: linear-gradient(rgba(139, 69, 19, 0.6), rgba(0, 0, 0, 0.6)),    
        url('https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=1500&q=80')    
        no-repeat center center/cover;    
      display: flex;    
      align-items: center;    
      justify-content: center;    
      color: white;    
      text-align: center;    
      padding: 0 1rem;    
      position: relative;    
    }    
    .banner-overlay { max-width: 800px; }    
    .banner-overlay h1 {    
      font-size: 3.5rem;    
      margin-bottom: 1rem;    
      animation: fadeInDown 1s ease forwards;    
    }    
    .banner-overlay p {    
      font-size: 1.5rem;    
      margin-bottom: 2rem;    
      animation: fadeInUp 1.2s ease forwards;    
    }    
    .banner .btn {    
      margin: 0.5rem;    
      padding: 1rem 2.5rem;    
      background: linear-gradient(135deg, #c97e3d, #8b4513);    
      color: white;    
      border: none;    
      border-radius: 8px;    
      font-size: 1.1rem;    
      font-weight: bold;    
      cursor: pointer;    
      transition: background 0.3s ease, transform 0.3s ease;    
    }    
    .banner .btn a { text-decoration: none; color: white; display: inline-block; width:100%; height:100%; }    
    .banner .btn:hover {    
      background: linear-gradient(135deg, #8b4513, #c97e3d);    
      transform: scale(1.05);    
    }    
    @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-30px); } 100% { opacity: 1; transform: translateY(0); } }    
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } }    
    
    /* About Section */    
    .about-section {    
      padding: 5rem 2rem;    
      background-color: #fffaf2;    
      max-width: 900px;    
      margin: 0 auto;    
      text-align: center;    
      color: #8b4513;    
    }    
    .about-section h2 { font-size: 2.5rem; margin-bottom: 2rem; }    
    .about-section p {    
      font-size: 1.2rem;    
      line-height: 1.8;    
      color: #333;    
      max-width: 800px;    
      margin: 0 auto;    
    }    
    
    /* Contact Section */    
    .contact-section {    
      padding: 5rem 2rem;    
      background-color: #f3e5d8;    
      text-align: center;    
    }    
    .contact-container { max-width: 900px; margin: 0 auto; }    
    .contact-icon { width: 60px; margin-bottom: 1.5rem; }    
    .contact-section h2 {    
      font-size: 2.5rem;    
      margin-bottom: 2rem;    
      color: #8b4513;    
    }    
    .contact-section p { margin: 0.8rem 0; font-size: 1.1rem; }    
    
    /* Footer */    
    footer {    
      background-color: #8b4513;    
      color: white;    
      text-align: center;    
      padding: 2rem 1rem;    
    }    
    .social-icons { margin: 1rem 0 1.5rem 0; }    
    .social-icons a {    
      color: white;    
      margin: 0 15px;    
      font-size: 1.8rem;    
      transition: color 0.3s ease;    
    }    
    .social-icons a:hover { color: #ffd9a0; transform: translateY(-3px); }    
    
    /* Responsive Design */    
    @media (max-width: 480px) {    
      .floating-icons div { width: 40px; height: 40px; }    
      .floating-icons div img { width: 22px; height: 22px; }    
    }    
  </style>    
</head>    
<body>    
    
  <!-- Floating Icons (Admin + Feedback + Cart) -->    
  <div class="floating-icons">    
    <div class="admin-icon">    
      <a href="login.php"><img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin" title="Admin Panel" /></a>    
    </div>    
    <div class="feedback-icon">    
      <a href="feedback.php"><img src="https://cdn-icons-png.flaticon.com/512/2462/2462719.png" alt="Feedback" title="User Feedback" /></a>    
    </div>    
    <div class="cart-float">    
      <a href="my_orders.php"><img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" alt="Cart" title="View Cart" /></a>    
    </div>    
  </div>    
    
  <!-- Header -->    
  <header>    
    <div class="header-container">    
      <div class="logo"><span>BookNest</span></div>    
    
      <?php    
      if (isset($_SESSION['username'])) {    
          $username = htmlspecialchars($_SESSION['username']);    
          echo '<div class="welcome-container">';    
          echo '<div class="welcome-message">' . $username . ' 👋</div>';    
          echo '<form method="post" action="" style="margin:0;">';    
          echo '<button type="submit" name="logout" class="logout-btn">Logout</button>';    
          echo '</form>';    
          echo '</div>';    
      }    
      ?>    
    </div>    
  </header>    
    
  <!-- Banner -->    
  <section class="banner">    
    <div class="banner-overlay">    
      <h1>Welcome to BookNest</h1>    
      <p>Your online destination for Malayalam & English books</p>    
      <button class="btn"><a href="mal.php">Shop Malayalam</a></button>    
      <button class="btn"><a href="eng.php">Shop English</a></button>    
    </div>    
  </section>    
    
  <!-- About Us Section -->    
  <section class="about-section" data-aos="fade-up">    
    <h2>About Us</h2>    
    <p>    
      BookNest is your trusted online bookstore offering a wide collection of Malayalam and English books.     
      From timeless classics to modern bestsellers, we bring literature to your doorstep.     
      Our mission is to spread the joy of reading by making books accessible and affordable for everyone.     
      Whether you're a student, professional, or casual reader, BookNest has something for you.    
    </p>    
  </section>    
    
  <!-- Contact Section -->    
  <section id="contact" class="contact-section">    
    <div class="contact-container">    
      <h2 data-aos="fade-up">Contact Us</h2>    
      <img src="https://cdn-icons-png.flaticon.com/512/597/597177.png" alt="Contact Icon" class="contact-icon" />    
      <p>Email: support@booknest.com</p>    
      <p>Phone: +91 98765 43210</p>    
      <p>Address: 456 Knowledge Lane, Readers City</p>    
    </div>    
  </section>    
    
  <!-- Footer -->    
  <footer>    
    <div class="social-icons">    
      <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>    
      <a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>    
      <a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>    
    </div>    
    <p>&copy; 2025 BookNest. All rights reserved.</p>    
  </footer>    
    
  <!-- AOS Script -->    
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>    
  <script>AOS.init({ duration: 800, once: true });</script>    
    
</body>    
</html>
