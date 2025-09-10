<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zenter Landing Page</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #38bdf8, #6366f1);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Navbar */
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 10%;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      background: rgba(30, 41, 59, 0.6);
      backdrop-filter: blur(10px);
      z-index: 1000;
      animation: slideDown 1s ease;
    }

    nav .logo {
      font-size: 24px;
      font-weight: bold;
      color: #38bdf8;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    nav ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 16px;
      transition: 0.3s;
    }

    nav ul li a:hover {
      color: #38bdf8;
    }

    .auth-buttons button {
      margin-left: 10px;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }

    .login-btn {
      background: transparent;
      color: #fff;
      border: 2px solid #38bdf8;
    }

    .login-btn:hover {
      background: #38bdf8;
      color: #fff;
    }

    .register-btn {
      background: #38bdf8;
      color: #fff;
    }

    .register-btn:hover {
      background: #6366f1;
    }

    /* Hero Section */
    .hero {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 100px 20px;
      animation: fadeIn 2s ease;
    }

    .hero-content {
      max-width: 700px;
      animation: zoomIn 1.5s ease;
    }

    .hero h1 {
      font-size: 48px;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 18px;
      margin-bottom: 30px;
      line-height: 1.6;
    }

    .hero button {
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      background: #fff;
      color: #1e293b;
      font-weight: bold;
      transition: transform 0.3s;
    }

    .hero button:hover {
      transform: scale(1.1);
      background: #38bdf8;
      color: #fff;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes zoomIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    @keyframes slideDown {
      from { transform: translateY(-100%); }
      to { transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      nav ul {
        display: none;
      }
      .auth-buttons {
        display: flex;
      }
      .hero h1 {
        font-size: 32px;
      }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav>
    <div class="logo">Zenter</div>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Features</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
    <div class="auth-buttons">
      <button class="login-btn">Login</button>
      <button class="register-btn">Register</button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Welcome to Zenter</h1>
      <p>
        The ultimate platform to manage your business effortlessly.  
        Track, analyze, and grow with powerful tools designed just for you.
      </p>
      <button>Get Started</button>
    </div>
  </section>
</body>
</html>
