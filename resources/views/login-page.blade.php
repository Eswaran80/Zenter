<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zenter | Login</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    body, html { height: 100%; background: #0F172A; overflow: hidden; color: #fff; }

    /* Background */
    .bg {
      position: fixed;
      width: 100%;
      height: 100%;
      background: url("images/bg-tech.jpg") no-repeat center center/cover;
      animation: zoom 25s infinite alternate;
      z-index: -2;
    }
    .overlay-bg {
      position: fixed;
      width: 100%;
      height: 100%;
      background: rgba(15,23,42,0.85);
      z-index: -1;
    }
    @keyframes zoom { from { transform: scale(1); } to { transform: scale(1.2); } }

    /* Center container */
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* Login card */
    .login-card {
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      backdrop-filter: blur(12px);
      padding: 50px 40px;
      border-radius: 20px;
      width: 350px;
      text-align: center;
      box-shadow: 0 0 30px rgba(0,0,0,0.4);
      animation: fadeIn 1.5s ease;
    }

    .login-card h2 {
      margin-bottom: 10px;
      color: #6C63FF;
    }

    .login-card p {
      font-size: 0.9rem;
      color: #bbb;
      margin-bottom: 30px;
    }

    /* Input fields */
    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group input {
      width: 100%;
      padding: 12px 40px 12px 45px;
      border: none;
      border-radius: 30px;
      background: rgba(255,255,255,0.1);
      color: #fff;
      font-size: 1rem;
      outline: none;
    }

    .input-group i {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      font-size: 1.2rem;
      color: #00C9A7;
    }

    /* Button */
    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 30px;
      background: #6C63FF;
      color: #fff;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 10px;
    }

    .btn:hover { background: #5848e5; }

    /* Links */
    .login-links {
      margin-top: 20px;
      font-size: 0.9rem;
    }
    .login-links a {
      color: #00C9A7;
      text-decoration: none;
      transition: color 0.3s;
    }
    .login-links a:hover { color: #6C63FF; }

     .btn1{
      cursor:pointer;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="bg"></div>
  <div class="overlay-bg"></div>

  <div class="container">
    <div class="login-card">
      <h2>Welcome Back</h2>
      <p>Login to continue with Zenter</p>

      <form action="" method="post">
        @csrf
        <div class="input-group">
          <i class="ri-mail-line"></i>
          <input type="email" placeholder="Email" required>
        </div>
        <div class="input-group">
          <i class="ri-lock-2-line"></i>
          <input type="password" placeholder="Password" required>
        </div>
        <button class="btn" type="" onclick="window.location='{{route('dashboard.show')}}'"  >Login</button>
      </form>

      <div class="login-links">
        <p><a href="#">Forgot Password?</a></p>
        <p>Don't have an account? <a class="btn1" onclick="window.location='{{route('register.show')}}'">Register</a></p>
      </div>
    </div>
  </div>
</body>
</html>
