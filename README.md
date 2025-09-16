<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BookVerse Admin Portal</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- AOS Animation Library -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      background: linear-gradient(135deg, #2c3e50 0%, #4a6572 100%);
      font-family: 'Roboto', sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
      position: relative;
      overflow: hidden;
    }
    
    /* Book-themed background elements */
    .book-decoration {
      position: absolute;
      opacity: 0.1;
      z-index: -1;
    }
    
    .book-1 {
      top: 10%;
      left: 10%;
      font-size: 5rem;
      color: #8d6e63;
    }
    
    .book-2 {
      bottom: 15%;
      right: 15%;
      font-size: 4rem;
      color: #a1887f;
    }
    
    .book-3 {
      top: 30%;
      right: 20%;
      font-size: 6rem;
      color: #bcaaa4;
    }
    
    .book-4 {
      bottom: 25%;
      left: 20%;
      font-size: 5.5rem;
      color: #d7ccc8;
    }
    
    .login-container {
      display: flex;
      width: 90%;
      max-width: 1000px;
      height: 550px;
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }
    
    .left-panel {
      flex: 1;
      background: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.8)), 
                  url('https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');
      background-size: cover;
      background-position: center;
      color: white;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
    }
    
    .left-panel::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(74, 101, 114, 0.85);
    }
    
    .left-content {
      position: relative;
      z-index: 2;
    }
    
    .logo {
      display: flex;
      align-items: center;
      margin-bottom: 30px;
    }
    
    .logo-icon {
      font-size: 2.5rem;
      margin-right: 15px;
      color: #ffab40;
    }
    
    .logo-text {
      font-family: 'Merriweather', serif;
      font-size: 1.8rem;
      font-weight: 700;
    }
    
    .welcome-text {
      margin-bottom: 25px;
    }
    
    .welcome-text h1 {
      font-family: 'Merriweather', serif;
      font-size: 2.2rem;
      margin-bottom: 15px;
      color: #ffab40;
    }
    
    .welcome-text p {
      line-height: 1.6;
      font-size: 1.1rem;
    }
    
    .features {
      margin-top: 30px;
    }
    
    .feature {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .feature-icon {
      width: 40px;
      height: 40px;
      background: rgba(255, 171, 64, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      color: #ffab40;
    }
    
    .feature-text {
      font-size: 0.95rem;
    }
    
    .right-panel {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: #f9f9f9;
    }
    
    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .login-header h2 {
      font-family: 'Merriweather', serif;
      font-size: 2rem;
      color: #2c3e50;
      margin-bottom: 10px;
    }
    
    .login-header p {
      color: #7f8c8d;
      font-size: 1rem;
    }
    
    .form-group {
      margin-bottom: 20px;
      position: relative;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #2c3e50;
      font-size: 0.9rem;
    }
    
    .input-with-icon {
      position: relative;
    }
    
    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #7f8c8d;
    }
    
    .form-group input {
      width: 100%;
      padding: 15px 15px 15px 45px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: white;
    }
    
    .form-group input:focus {
      outline: none;
      border-color: #ffab40;
      box-shadow: 0 0 0 3px rgba(255, 171, 64, 0.2);
    }
    
    .btn-login {
      background: linear-gradient(to right, #ffab40, #ff8a00);
      border: none;
      padding: 15px;
      font-size: 1rem;
      font-weight: 500;
      color: white;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s ease;
      margin-top: 10px;
    }
    
    .btn-login:hover {
      background: linear-gradient(to right, #ff8a00, #ff6d00);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 141, 0, 0.4);
    }
    
    .error {
      color: #e74c3c;
      font-size: 0.9rem;
      margin-top: 5px;
      text-align: center;
      min-height: 20px;
    }
    
    .footer {
      text-align: center;
      margin-top: 20px;
      color: #7f8c8d;
      font-size: 0.85rem;
    }
    
    @media (max-width: 900px) {
      .login-container {
        flex-direction: column;
        height: auto;
        max-width: 500px;
      }
      
      .left-panel {
        display: none;
      }
    }
  </style>
</head>
<body>
  <!-- Decorative book icons -->
  <i class="book-decoration book-1 fas fa-book"></i>
  <i class="book-decoration book-2 fas fa-book-open"></i>
  <i class="book-decoration book-3 fas fa-book-reader"></i>
  <i class="book-decoration book-4 fas fa-bookmark"></i>

  <div class="login-container" data-aos="zoom-in">
    <div class="left-panel">
      <div class="left-content">
        <div class="logo">
          <i class="logo-icon fas fa-book"></i>
          <div class="logo-text">BookVerse</div>
        </div>
        
        <div class="welcome-text">
          <h1>Admin Portal</h1>
          <p>Access your bookstore management dashboard to manage inventory, orders, and customer data.</p>
        </div>
        
        <div class="features">
          <div class="feature">
            <div class="feature-icon">
              <i class="fas fa-book"></i>
            </div>
            <div class="feature-text">Manage book inventory and categories</div>
          </div>
          
          <div class="feature">
            <div class="feature-icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="feature-text">Process orders and track shipments</div>
          </div>
          
          <div class="feature">
            <div class="feature-icon">
              <i class="fas fa-chart-line"></i>
            </div>
            <div class="feature-text">View sales analytics and reports</div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="right-panel">
      <div class="login-header">
        <h2>Admin Login</h2>
        <p>Enter your credentials to access the dashboard</p>
      </div>
      
      <form id="loginForm">
        <div class="form-group">
          <label for="username">Admin Name</label>
          <div class="input-with-icon">
            <i class="input-icon fas fa-user"></i>
            <input type="text" id="username" placeholder="Enter admin username" required />
          </div>
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-with-icon">
            <i class="input-icon fas fa-lock"></i>
            <input type="password" id="password" placeholder="Enter your password" required />
          </div>
        </div>
        
        <div id="errorMsg" class="error"></div>
        
        <button type="submit" class="btn-login">Sign In</button>
      </form>
      
      <div class="footer">
        <p>© 2023 BookVerse Admin Portal. All rights reserved.</p>
      </div>
    </div>
  </div>

  <!-- AOS Script -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();

    const form = document.getElementById("loginForm");
    const errorMsg = document.getElementById("errorMsg");

    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("password").value;

      if (username === "Admin" && password === "00007777") {
        window.location.href = "admin.php";
      } else {
        errorMsg.textContent = "Invalid admin credentials. Please try again.";
      }
    });
  </script>
</body>
</html>
