<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zenter | Register</title>
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

    /* Register card */
    .register-card {
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      backdrop-filter: blur(12px);
      padding: 50px 40px;
      border-radius: 20px;
      width: 380px;
      text-align: center;
      box-shadow: 0 0 30px rgba(0,0,0,0.4);
      animation: fadeIn 1.5s ease;
    }

    .register-card h2 {
      margin-bottom: 10px;
      color: #6C63FF;
    }

    .register-card p {
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
      background: #00C9A7;
      color: #fff;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 10px;
    }

    .btn:hover { background: #00a78a; }

    /* Links */
    .register-links {
      margin-top: 20px;
      font-size: 0.9rem;
    }
    .btn1{
      cursor:pointer;
    }
    .register-links a {
      color: #6C63FF;
      text-decoration: none;
      transition: color 0.3s;
    }
    .register-links a:hover { color: #00C9A7; }

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
    <div class="register-card">
      <h2>Create Account</h2>
      <p>Join Zenter today and start managing your tasks smarter 🚀</p>

      <form action="{{route('login.store')}}" method="post">
        @csrf
        <div class="input-group">
          <i class="ri-user-line"></i>
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
          <i class="ri-mail-line"></i>
          <input type="" name="email" placeholder="Email" required>
        </div>
        <div class="input-group">
          <i class="ri-lock-2-line"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
      @if (session('error'))
    <p id="errorMsg" style="color: rgb(235, 110, 0)">{{ session('error') }}</p>

     <script>
        setTimeout(() => {
            document.getElementById('errorMsg').style.display = 'none';
        }, 5000); // 5000ms = 5 seconds
    </script>
     @endif


        <button class="btn" type="submit">Sign Up</button>
      </form>

      <div class="register-links">
        <p>Already have an account? <a class="btn1" onclick="window.location='{{route('login.show')}}'">Login</a></p>
      </div>
    </div>
  </div>
</body>
</html>
