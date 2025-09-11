<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zenter | Landing Page</title>
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body, html {
      height: 100%;
      overflow: hidden;
    }

    /* Background with animation */
    .bg {
      position: absolute;
      width: 100%;
      height: 100%;
      background: url("https://images.unsplash.com/photo-1507525428034-b723cf961d3e") no-repeat center center/cover;
      animation: zoom 25s infinite alternate;
      z-index: -1;
    }

    @keyframes zoom {
      from { transform: scale(1); }
      to { transform: scale(1.2); }
    }

    /* Navbar */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 60px;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(6px);
      z-index: 1000;
    }

    nav .logo {
      font-size: 1.8rem;
      font-weight: bold;
      color: #fff;
      letter-spacing: 2px;
    }

    nav ul {
      display: flex;
      list-style: none;
      gap: 30px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-size: 1rem;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    nav ul li a:hover {
      color: #ff9800;
    }

    /* Overlay content */
    .overlay {
      height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      padding: 20px;
      color: #fff;
    }

    .overlay h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      animation: fadeInDown 2s;
    }

    .overlay p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      animation: fadeIn 3s;
    }

    /* Buttons */
    .btn-group {
      display: flex;
      gap: 20px;
    }

    .btn {
      padding: 12px 28px;
      border: none;
      border-radius: 30px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-login {
      background: #ff9800;
      color: #fff;
    }

    .btn-login:hover {
      background: #e68900;
    }

    .btn-register {
      background: #4CAF50;
      color: #fff;
    }

    .btn-register:hover {
      background: #3e8e41;
    }

    /* Animations */
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-50px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="bg"></div>

  <!-- Navbar -->
  <nav>
    <div class="logo">Zenter</div>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>

  <!-- Landing Content -->
  <div class="overlay">
    <h1>Welcome to Zenter</h1>
    <p>Your smart solution for the future 🚀</p>
    <div class="btn-group">
      <button class="btn btn-login" onclick="window.location.href='login.html'">Login</button>
      <button class="btn btn-register" onclick="window.location.href='register.html'">Register</button>
    </div>
  </div>
</body>
</html>
