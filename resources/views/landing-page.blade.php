<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zenter | Task Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body, html {
      color: #fff;
      overflow-x: hidden;
      height: 100%;
    }

    /* New Background Image + Overlay */
    .bg {
      position: fixed;
      width: 100%;
      height: 100%;
      background: url("https://images.unsplash.com/photo-1593642634367-something-tech") no-repeat center center/cover;
      /* Replace URL above with one of the free ones you like, e.g. from the selection */
      animation: zoom 25s infinite alternate;
      z-index: -2;
    }
    .overlay-bg {
      position: fixed;
      width: 100%;
      height: 100%;
      background: rgba(15,23,42,0.9);
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
      background: rgba(15,23,42,0.8);
      backdrop-filter: blur(8px);
      z-index: 1000;
    }
    nav .logo {
      font-size: 1.8rem;
      font-weight: bold;
      color: #6C63FF;
      letter-spacing: 2px;
    }
    nav ul {
      display: flex;
      list-style: none;
      gap: 30px;
    }
    nav ul li a {
      color: #ddd;
      text-decoration: none;
      font-size: 1rem;
      transition: color 0.3s;
    }
    nav ul li a:hover {
      color: #00C9A7;
    }

    /* Sections */
    section {
      padding: 100px 20px;
      text-align: center;
      position: relative;
      z-index: 1;
    }
    h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      color: #6C63FF;
    }
    p {
      max-width: 800px;
      margin: auto;
      font-size: 1.1rem;
      margin-bottom: 40px;
      color: #bbb;
    }

    /* Hero */
    .hero {
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    .hero h1 {
      font-size: 3.5rem;
      margin-bottom: 15px;
      color: #fff;
    }
    .btn-group {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }
    .btn {
      padding: 14px 32px;
      border: none;
      border-radius: 30px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    .btn-login {
      background: #6C63FF;
      color: #fff;
    }
    .btn-login:hover {
      background: #5848e5;
    }
    .btn-register {
      background: #00C9A7;
      color: #fff;
    }
    .btn-register:hover {
      background: #00a78a;
    }

    /* Cards (Features, etc) */
    .features, .how-it-works, .testimonials, .pricing {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
    }
    .feature-card, .step-card, .testimonial-card, .price-card {
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 20px;
      padding: 30px;
      width: 280px;
      text-align: center;
      backdrop-filter: blur(6px);
      transition: transform 0.3s, border 0.3s;
    }
    .feature-card:hover, .step-card:hover, .testimonial-card:hover, .price-card:hover {
      transform: translateY(-10px);
      border: 1px solid #6C63FF;
    }
    i {
      font-size: 2rem;
      color: #00C9A7;
      margin-bottom: 15px;
    }

    /* Pricing */
    .price-card h3 {
      margin-bottom: 10px;
      color: #6C63FF;
    }
    .price {
      font-size: 1.8rem;
      margin: 15px 0;
      color: #00C9A7;
    }

    /* Footer */
    footer {
      padding: 40px 20px;
      text-align: center;
      background: rgba(15,23,42,0.95);
      position: relative;
      z-index: 1;
    }
    footer p {
      color: #777;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="bg"></div>
  <div class="overlay-bg"></div>

  <!-- Navbar -->
  <nav>
    <div class="logo">Zenter</div>
    <ul>
      <li><a href="#hero">Home</a></li>
      <li><a href="#features">Features</a></li>
      <li><a href="#how">How It Works</a></li>
      <li><a href="#pricing">Pricing</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>

  <!-- Hero Section -->
  <section class="hero" id="hero">
    <h1>Organize Tasks. Boost Productivity.</h1>
    <p>Manage your projects effortlessly with Zenter — your all-in-one Task Manager designed for teams & individuals 🚀</p>
    <div class="btn-group">
      <button class="btn btn-login">Login</button>
      <button class="btn btn-register">Register</button>
    </div>
  </section>

  <!-- Features -->
  <section id="features">
    <h2>Features</h2>
    <p>Powerful tools to keep your tasks organized and your team productive.</p>
    <div class="features">
      <div class="feature-card"><i class="ri-time-line"></i><h3>Track Deadlines</h3><p>Never miss a due date with smart reminders and schedules.</p></div>
      <div class="feature-card"><i class="ri-team-line"></i><h3>Team Collaboration</h3><p>Work together seamlessly with shared projects and tasks.</p></div>
      <div class="feature-card"><i class="ri-bar-chart-box-line"></i><h3>Boost Productivity</h3><p>Stay on top of your goals with analytics & insights.</p></div>
    </div>
  </section>

  <!-- How It Works -->
  <section id="how">
    <h2>How It Works</h2>
    <p>Get started in just three simple steps.</p>
    <div class="how-it-works">
      <div class="step-card"><i class="ri-user-add-line"></i><h3>1. Sign Up</h3><p>Create your free account and join Zenter.</p></div>
      <div class="step-card"><i class="ri-todo-line"></i><h3>2. Add Tasks</h3><p>Organize tasks, set deadlines, and assign to your team.</p></div>
      <div class="step-card"><i class="ri-rocket-line"></i><h3>3. Achieve Goals</h3><p>Track progress and boost your productivity.</p></div>
    </div>
  </section>

  <!-- Testimonials -->
  <section id="testimonials">
    <h2>What Our Users Say</h2>
    <div class="testimonials">
      <div class="testimonial-card"><p>"Zenter transformed how we manage projects. Deadlines are now stress-free!"</p><h4>- Sarah, Project Manager</h4></div>
      <div class="testimonial-card"><p>"Perfect for my startup team. Task assignment and tracking are seamless."</p><h4>- David, Founder</h4></div>
      <div class="testimonial-card"><p>"As a freelancer, Zenter helps me keep track of multiple clients with ease."</p><h4>- Mia, Designer</h4></div>
    </div>
  </section>

  <!-- Pricing -->
  <section id="pricing">
    <h2>Pricing Plans</h2>
    <p>Choose a plan that suits your needs.</p>
    <div class="pricing">
      <div class="price-card"><h3>Free</h3><div class="price">$0/mo</div><p>Basic task management for individuals.</p></div>
      <div class="price-card"><h3>Pro</h3><div class="price">$9.99/mo</div><p>Advanced features for small teams.</p></div>
      <div class="price-card"><h3>Enterprise</h3><div class="price">$29.99/mo</div><p>Full suite with analytics & support.</p></div>
    </div>
  </section>

  <!-- Footer -->
  <footer id="contact">
    <p>© 2025 Zenter. All rights reserved.</p>
  </footer>
</body>
</html>
