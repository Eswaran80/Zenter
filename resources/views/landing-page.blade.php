<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Zenter — Productivity UI</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <meta name="description" content="SaaS-style landing: animated hero, glass cards, scroll animations, 3D headings" />

  <style>
    /* =========================
       Variables & base styles
       ========================= */
    :root{
      --bg: #f4f5fa;
      --muted: #aab0c8;
      --accent1: #6C63FF; /* purple */
      --accent2: #5848E5;
      --accent3: #00C9A7; /* teal */
      --accent4: #00a78a;
      --glass: rgba(248, 242, 242, 0.703);
      --glass-2: rgba(255, 255, 255, 0.932);
      --card-shadow: 0 10px 30px rgba(11,12,26,0.6);
      --radius: 16px;
      --max-width: 1200px;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: linear-gradient(180deg, #06060a 0%, #0f1020 70%);
      color: #e7ecff;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      line-height:1.45;
      overflow-x:hidden;
    }

    a{color:inherit; text-decoration:none}
    .container{max-width:var(--max-width); margin:0 auto; padding:0 24px}

    /* =========================
       Nav
       ========================= */
    header{
      position:fixed; top:0; left:0; right:0; z-index:1000;
      backdrop-filter: blur(8px) saturate(110%);
      background: linear-gradient(180deg, rgba(10,10,18,0.4), rgba(10,10,18,0.15));
      border-bottom: 1px solid rgba(255,255,255,0.03);
    }
    .nav {
      height:72px; display:flex; align-items:center; justify-content:space-between;
    }
    .brand { display:flex; align-items:center; gap:10px; font-family: "Montserrat"; font-weight:700; letter-spacing:0.6px; }
    .brand .dot { width:36px; height:36px; border-radius:10px;
      background: linear-gradient(135deg,var(--accent1),var(--accent2));
      box-shadow: 0 6px 18px rgba(88,72,229,0.28), inset 0 -4px 10px rgba(255,255,255,0.08);
      display:inline-block;
    }
    nav .links { display:flex; gap:18px; align-items:center; font-weight:600; color:var(--muted); }
    .cta-buttons { display:flex; gap:12px; align-items:center; }

    .btn {
      font-family: "Montserrat";
      border: none;
      padding: 10px 16px;
      border-radius: 12px;
      cursor:pointer;
      font-weight:700;
      letter-spacing:0.4px;
      transition: transform .18s cubic-bezier(.2,.9,.2,1), box-shadow .18s;
      will-change: transform;
      display:inline-flex; align-items:center; gap:8px;
    }

    .btn-primary{
      background: linear-gradient(90deg,var(--accent1),var(--accent2));
      color:white;
      box-shadow: 0 8px 24px rgba(92,75,230,0.28), 0 2px 8px rgba(0,0,0,0.6);
    }
    .btn-primary:hover{ transform: translateY(-5px) scale(1.02); box-shadow: 0 18px 40px rgba(92,75,230,0.34); }
    .btn-ghost{
      background: transparent;
      border: 1px solid rgba(255,255,255,0.06);
      color:var(--muted);
      box-shadow: none;
    }
    .btn-ghost:hover{ transform: translateY(-3px); box-shadow: 0 10px 20px rgba(2,6,23,0.6); }

    /* =========================
       HERO
       ========================= */
    .hero {
      min-height:100vh;
      display:grid;
      grid-template-columns: 1fr 520px;
      align-items:center;
      gap:48px;
      padding-top:84px; /* offset for fixed header */
      padding-bottom:80px;
    }
    @media (max-width:1100px){
      .hero { grid-template-columns: 1fr; padding-bottom:40px; padding-top:110px; gap:28px; }
    }

    .hero-left {
      padding: 12px 6px;
    }

    .headline {
      font-family:"Montserrat";
      font-weight:900;
      font-size: clamp(36px, 6vw, 64px);
      line-height:0.95;
      margin:0 0 18px 0;
      letter-spacing:-1px;
      display:inline-block;
      background: linear-gradient(90deg, #fff 0%, #d8ddff 10%, rgba(255,255,255,0.06) 100%);
      -webkit-background-clip:text;
      background-clip:text;
      color:transparent;
      position:relative;
      transform-style:preserve-3d;
      text-shadow:
        0 1px 0 rgba(255,255,255,0.02),
        0 6px 20px rgba(9,10,25,0.6);
    }

    /* 3D animated gradient + subtle rotation */
    .headline-wrap{
      display:inline-block;
      transform-origin:center;
      animation: floatHeadline 6s ease-in-out infinite;
    }
    @keyframes floatHeadline {
      0%{ transform: rotateX(0.8deg) rotateY(0.4deg) translateZ(0); }
      50%{ transform: rotateX(-0.8deg) rotateY(-0.6deg) translateZ(6px); }
      100%{ transform: rotateX(0.8deg) rotateY(0.4deg) translateZ(0); }
    }

    /* 3D shadow text behind heading using pseudo-element */
    .headline::after {
      content: attr(data-shadow);
      position:absolute;
      left:6px; top:10px;
      z-index:-1;
      filter: blur(10px);
      opacity:0.14;
      color:#000;
      transform: skewX(-8deg) rotateX(20deg);
      font-family:"Montserrat";
      font-weight:900;
      pointer-events:none;
      width:100%;
    }

    .subhead {
      color:var(--muted);
      max-width:700px;
      margin-bottom:18px;
      font-size:1.05rem;
    }

    .hero-cta { display:flex; gap:14px; align-items:center; margin-top:6px; }

    /* Tagline chips */
    .chips { display:flex; gap:8px; margin-top:18px; flex-wrap:wrap; }
    .chip {
      background: linear-gradient(90deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
      border-radius:999px;
      padding:8px 12px;
      font-weight:600;
      color:var(--muted);
      font-size:0.84rem;
      border:1px solid rgba(255,255,255,0.03);
      backdrop-filter: blur(6px);
    }

    /* Right side: photo cards stack */
    .hero-right {
      position:relative;
      height: 72vh;
      min-height:420px;
      display:flex;
      align-items:center;
      justify-content:center;
      perspective:1400px;
    }
    @media (max-width:1100px){ .hero-right{ height:560px; min-height:420px } }

    .card-stack {
      width:420px;
      height:60%;
      position:relative;
      transform-style:preserve-3d;
    }
    @media (max-width:1100px){ .card-stack{ width:90%; height:420px } }

    .photo-card {
      position:absolute;
      width:100%;
      height:100%;
      border-radius:20px;
      overflow:hidden;
      display:flex;
      align-items:flex-end;
      justify-content:flex-start;
      padding:18px;
      box-shadow: var(--card-shadow);
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      transform-origin:center;
      transition: transform .35s cubic-bezier(.2,.9,.2,1), box-shadow .35s;
      opacity:0; /* revealed by JS with staggered animation */
      backface-visibility:hidden;
      border: 1px solid rgba(255,255,255,0.04);
      backdrop-filter: blur(8px) saturate(120%);
    }

    .photo-card .meta {
      color:white;
      text-shadow:0 6px 18px rgba(0,0,0,0.6);
      font-weight:700;
      font-family: "Montserrat";
      font-size:1.05rem;
      display:flex; flex-direction:column; gap:6px;
    }
    .photo-card .meta small{ font-weight:500; font-size:0.85rem; color:rgba(255,255,255,0.85) }

    .photo-card img{
      position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:-1; transform-origin:center; transition: transform .6s ease;
      filter: saturate(1.05) contrast(1.05);
    }

    /* Unique transforms for stacked look (these are initial offsets) */
    .photo-card.c0{ transform: translate3d(-18px,-8px,-30px) rotateZ(-3deg); }
    .photo-card.c1{ transform: translate3d(6px,6px,-18px) rotateZ(1.2deg) scale(0.98); }
    .photo-card.c2{ transform: translate3d(22px,20px,0px) rotateZ(3.6deg) scale(0.96); }

    /* When hovered, lift front card and rotate a bit (3D hover) */
    .card-stack:hover .photo-card { transform: translateY(6px) scale(0.995); filter:brightness(.98); }
    .card-stack .photo-card:hover{
      transform: translateY(-18px) translateZ(40px) rotateX(6deg) rotateY(-6deg) scale(1.02);
      box-shadow: 0 28px 60px rgba(6,7,18,0.72);
    }

    /* subtle info pill inside card */
    .pill {
      display:inline-flex; gap:8px; align-items:center;
      padding:8px 12px; border-radius:999px; background:linear-gradient(90deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); font-weight:600;
      backdrop-filter:blur(6px); border:1px solid rgba(255,255,255,0.04)
    }

    /* Reveal animation for cards */
    @keyframes cardIn {
      0%{ opacity:0; transform: translateY(40px) scale(.98) rotateZ(2deg); filter:blur(6px) }
      60%{ opacity:1; transform: translateY(-6px) scale(1.01) rotateZ(-1deg); filter:blur(0) }
      100%{ opacity:1; transform: translateY(0) scale(1) rotateZ(0) }
    }

    /* =========================
       SECTIONS (scrolling)
       ========================= */
    section.scroll-section{
      padding:90px 0;
      position:relative;
    }
    .split {
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:36px;
      align-items:center;
    }
    @media (max-width:900px){ .split{ grid-template-columns:1fr; gap:22px } }

    .split .text {
      padding: 12px 8px;
    }
    .split h3 {
      font-family:"Montserrat";
      font-weight:800;
      font-size: clamp(22px, 3.6vw, 34px);
      margin:0 0 12px;
      background: linear-gradient(90deg,var(--accent1),var(--accent3));
      -webkit-background-clip:text; background-clip:text;
      color:transparent;
      text-shadow: 0 14px 30px rgba(6,7,22,0.55);
    }
    .split p { color:var(--muted); margin:0 0 16px; max-width:560px; }

    .media {
      position:relative;
      min-height:280px;
      display:flex;
      align-items:center;
      justify-content:center;
      overflow:visible;
    }

    .media .image-wrap{
      width:100%;
      max-width:520px;
      border-radius:16px;
      overflow:hidden;
      box-shadow: 0 20px 40px rgba(4,5,18,0.6);
      border:1px solid rgba(255,255,255,0.04);
      transform: translateX(0);
      opacity:0;
      transition: transform .7s cubic-bezier(.2,.9,.2,1), opacity .7s;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      backdrop-filter: blur(6px) saturate(110%);
    }
    .media .image-wrap img{ width:100%; height:100%; object-fit:cover; display:block; }

    /* left slide in and right slide in effects */
    .from-left.in { transform: translateX(0); opacity:1; }
    .from-left { transform: translateX(-40px); opacity:0; }
    .from-right.in { transform: translateX(0); opacity:1; }
    .from-right { transform: translateX(40px); opacity:0; }

    /* text reveal */
    .reveal { opacity:0; transform: translateY(18px); transition: transform .6s, opacity .6s; }
    .reveal.in { opacity:1; transform: translateY(0); }

    /* subtle image inner glow for emphasis */
    .image-wrap::after {
      content:"";
      position:absolute; inset:0; pointer-events:none;
      background: linear-gradient(180deg, rgba(108,99,255,0.08) 0%, transparent 30%);
      mix-blend-mode:screen;
    }

    /* =========================
       Feature cards grid (staggered)
       ========================= */
    .features {
      display:grid;
      grid-template-columns: repeat(3,1fr);
      gap:20px;
      margin-top:18px;
    }
    @media (max-width:980px){ .features{ grid-template-columns: repeat(2,1fr) } }
    @media (max-width:640px){ .features{ grid-template-columns: 1fr } }

    .feature-card {
      border-radius:14px;
      padding:18px;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border:1px solid rgba(255,255,255,0.04);
      box-shadow: 0 10px 30px rgba(3,4,18,0.6);
      transform: translateY(20px);
      opacity:0;
      transition: transform .5s cubic-bezier(.2,.9,.2,1), opacity .5s;
      display:flex; gap:12px; align-items:flex-start;
      backdrop-filter: blur(6px);
    }
    .feature-card.in { transform: translateY(0); opacity:1; }
    .feature-card .icon {
      width:54px; height:54px; border-radius:12px; display:flex; align-items:center; justify-content:center;
      background: linear-gradient(135deg,var(--accent3),var(--accent4));
      font-weight:800; color:white; font-family:"Montserrat";
      box-shadow: 0 10px 30px rgba(0,167,138,0.12);
      flex-shrink:0;
    }
    .feature-card h4 { margin:0; font-family:"Montserrat"; font-weight:700; font-size:1.05rem }
    .feature-card p { margin:6px 0 0; color:var(--muted); font-size:0.94rem }

    /* =========================
       Footer
       ========================= */
    footer {
      padding:44px 0 80px; margin-top:40px;
      border-top: 1px solid rgba(255,255,255,0.03);
      background: linear-gradient(180deg, rgba(255,255,255,0.01), transparent);
    }
    .footer-grid {
      display:grid;
      grid-template-columns: 1fr 1fr 1fr 220px;
      gap:20px;
      align-items:start;
    }
    @media (max-width:900px){ .footer-grid{ grid-template-columns: 1fr 1fr; } }
    @media (max-width:640px){ .footer-grid{ grid-template-columns: 1fr; } }

    .footer-col h5 { font-family:"Montserrat"; font-weight:700; margin-bottom:8px; }
    .socials { display:flex; gap:12px; margin-top:12px; }
    .socials a{ width:44px; height:44px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; font-weight:700; background:linear-gradient(90deg,var(--accent1),var(--accent2)); color:white; box-shadow: 0 12px 30px rgba(92,75,230,0.16) }

    .footer-note { text-align:center; margin-top:28px; color:var(--muted) }

    /* gradient separator */
    .sep {
      height:2px; border-radius:2px; margin:24px 0;
      background: linear-gradient(90deg, rgba(108,99,255,0.42), rgba(0,201,167,0.34));
      opacity:0.8;
    }

    /* =========================
       Responsive tweaks for hero cards stack collapse
       ========================= */
    @media (max-width:720px){
      .card-stack{ height:360px; width:100% }
      .photo-card{ border-radius:14px }
      .headline { font-size: 34px; }
      header .nav { height:64px }
      .brand .dot { width:30px; height:30px; border-radius:8px }
    }

    /* tiny utility */
    .muted { color:var(--muted) }
    .mt-8{ margin-top:8px }
    .center { text-align:center }
  </style>
</head>
<body>
  <header>
    <div class="container nav">
      <div class="brand">
        <span class="dot" aria-hidden="true"></span>
        <div>
          <div style="font-size:0.92rem">Zenter</div>
          <small style="color:var(--muted); font-size:0.72rem">Productivity UI</small>
        </div>
      </div>

      <nav class="links" aria-label="Main navigation">
        <a href="#features" class="muted">Features</a>
        <a href="#work" class="muted">How it works</a>
        <a href="#pricing" class="muted">Pricing</a>
        <div class="cta-buttons">
          <button class="btn btn-ghost" onclick="window.location='{{route('login.show')}}'">Login</button>
          <button class="btn btn-primary" onclick="document.getElementById('signup').scrollIntoView({behavior:'smooth'})">Get started</button>
        </div>
      </nav>
    </div>
  </header>

  <main>
    <!-- HERO -->
    <section class="hero container" role="region" aria-label="Hero">
      <div class="hero-left">
        <div class="headline-wrap">
          <h1 class="headline" data-shadow="Manage tasks • Ship faster • Stay focused">
            Manage tasks. Ship faster. Stay focused.
          </h1>
        </div>

        <p class="subhead">
          A modern dashboard for teams and builders — elegant task cards, real-time focus mode, and smooth animations to
          keep your flow intact. Built with performance and delightful micro-interactions.
        </p>

        <div class="hero-cta">
          <button class="btn btn-primary" id="primaryCta">Start free trial</button>
          <button class="btn btn-ghost">Watch demo</button>
        </div>

        <div class="chips" aria-hidden="true">
          <span class="chip">Real-time sync</span>
          <span class="chip">Smart priorities</span>
          <span class="chip">Focus mode</span>
          <span class="chip">Integrations</span>
        </div>
      </div>

      <div class="hero-right" aria-hidden="false">
        <div class="card-stack" id="cardStack" aria-hidden="false">
          <!-- Photo cards - use Unsplash images (free to use) -->
          <article class="photo-card c0" data-i="0" aria-label="Photo card 1">
            <img src="https://images.unsplash.com/photo-1527689368864-3a821dbccc34?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=7c8c9e402f2e1f7d5f7a4f4e1f0b9b8b" alt="Workspace with notebook and coffee">
            <div class="meta">
              <div class="pill">Focus Sprint</div>
              <small>3 tasks • 25 min</small>
            </div>
          </article>

          <article class="photo-card c1" data-i="1" aria-label="Photo card 2">
            <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=0a4c5c6c9f7be8d3b6b4c3a2d0e1f0a9" alt="Team discussing product on a table">
            <div class="meta">
              <div class="pill">Sprint Planning</div>
              <small>Team • 5 members</small>
            </div>
          </article>

          <article class="photo-card c2" data-i="2" aria-label="Photo card 3">
            <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=9a3a613c1b6f7b9b4f0a2d2e0c7a3e4f" alt="Laptop with code on screen">
            <div class="meta">
              <div class="pill">Dev Pipeline</div>
              <small>CI • Automations</small>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- SECTION 1: Features -->
    <section id="features" class="scroll-section container" aria-label="Features">
      <div class="split">
        <div class="text">
          <h3 class="reveal">Design-led productivity for teams</h3>
          <p class="reveal">Cards that feel tactile, headings that pop with depth, and interactions that keep attention.
            Slide in images, glass surfaces, and gradient accents make the experience feel premium without sacrificing clarity.</p>

          <div class="features" id="featuresGrid">
            <div class="feature-card" data-i="0">
              <div class="icon">⏱</div>
              <div>
                <h4>Focus Sprints</h4>
                <p>Structured sprints with timers and concentration analytics.</p>
              </div>
            </div>

            <div class="feature-card" data-i="1">
              <div class="icon">🧭</div>
              <div>
                <h4>Smart Priorities</h4>
                <p>Auto-prioritization and intelligent backlog sorting.</p>
              </div>
            </div>

            <div class="feature-card" data-i="2">
              <div class="icon">🔌</div>
              <div>
                <h4>Rich Integrations</h4>
                <p>Connect to your tools and automate repetitive flows.</p>
              </div>
            </div>
          </div>

        </div>

        <div class="media">
          <div class="image-wrap from-right" style="--delay:0.05s">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&s=8a7b1e2f6e3f2a9a7e0b7c9d6b3a8f11" alt="Dashboard screenshot">
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 2: How it works (alternating) -->
    <section id="work" class="scroll-section container" aria-label="How it works">
      <div class="split">
        <div class="media">
          <div class="image-wrap from-left" style="--delay:0.05s">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&s=f4b4b4f3d1e2c3b5a0a1c8f6a9b7c4e" alt="People using a whiteboard">
          </div>
        </div>

        <div class="text">
          <h3 class="reveal">From plan to done — faster</h3>
          <p class="reveal">Create cards, assign owners, run focus sprints, and close tasks — all in a single flow. Visual cues, subtle parallax, and layered depth keep your attention where it matters.</p>

          <ul class="reveal muted" style="margin-top:16px; padding-left:18px;">
            <li>Quick card creation with templates</li>
            <li>Smart reminders and due-date nudges</li>
            <li>One-click progress insights</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- signup quick -->
    <section id="signup" class="scroll-section container center" aria-label="Signup">
      <div style="max-width:700px; margin:0 auto">
        <h3 class="reveal">Start your free trial</h3>
        <p class="reveal muted">No credit card required. Cancel anytime.</p>

        <form style="display:flex; gap:12px; margin-top:14px; justify-content:center; flex-wrap:wrap">
          <input type="email" placeholder="Email address" required style="padding:12px 16px; border-radius:12px; border:1px solid rgba(255,255,255,0.06); background:transparent; color:inherit; max-width:320px">
          <button class="btn btn-primary" type="submit">Create account</button>
        </form>
      </div>
    </section>

    <div class="sep container" aria-hidden="true"></div>

    <!-- FOOTER -->
    <footer>
      <div class="container">
        <div class="footer-grid">
          <div class="footer-col">
            <h5>Zenter</h5>
            <p class="muted">A delightful interface for focused teams. Built with beautiful micro-interactions and components.</p>
            <div class="socials" role="list">
              <a href="#" aria-label="Twitter">T</a>
              <a href="#" aria-label="LinkedIn">in</a>
              <a href="#" aria-label="GitHub">GH</a>
            </div>
          </div>

          <div class="footer-col">
            <h5>Product</h5>
            <ul style="list-style:none; padding:0; margin:0; color:var(--muted)">
              <li style="margin-bottom:8px">Features</li>
              <li style="margin-bottom:8px">Integrations</li>
              <li style="margin-bottom:8px">Pricing</li>
              <li style="margin-bottom:8px">Docs</li>
            </ul>
          </div>

          <div class="footer-col">
            <h5>Company</h5>
            <ul style="list-style:none; padding:0; margin:0; color:var(--muted)">
              <li style="margin-bottom:8px">About</li>
              <li style="margin-bottom:8px">Careers</li>
              <li style="margin-bottom:8px">Press</li>
              <li style="margin-bottom:8px">Legal</li>
            </ul>
          </div>

          <div class="footer-col">
            <h5>Contact</h5>
            <p class="muted">support@zenter.example</p>
            <div style="margin-top:12px">
              <small class="muted">Subscribe to updates</small>
              <div style="display:flex; gap:8px; margin-top:8px">
                <input placeholder="Email address" style="flex:1; padding:10px 12px; border-radius:10px; border:1px solid rgba(255,255,255,0.04); background:transparent; color:inherit">
                <button class="btn btn-primary">Subscribe</button>
              </div>
            </div>
          </div>
        </div>

        <div class="footer-note">
          <small class="muted">© <span id="yr"></span> Zenter • Crafted with ❤️</small>
        </div>
      </div>
    </footer>
  </main>

  <!-- =========================
       JS: Parallax, shuffle, IntersectionObserver reveals
       ========================= -->
  <script>
    // small helper to set year
    document.getElementById('yr').textContent = new Date().getFullYear();

    // 1) Shuffle photo cards order on load for "shuffle" effect
    (function shuffleCards(){
      const stack = document.getElementById('cardStack');
      if(!stack) return;
      const cards = Array.from(stack.querySelectorAll('.photo-card'));
      // randomize a copy of indices but keep them visually placed (z-index)
      const order = cards.map((c,i)=>i).sort(()=>Math.random()-0.5);
      cards.forEach((card,i)=>{
        // set zIndex to match shuffled order
        card.style.zIndex = String(100 - i);
        // slight CSS animation stagger
        const delay = 120 * i;
        // reveal with animation
        setTimeout(()=>{
          card.style.animation = 'cardIn 700ms cubic-bezier(.2,.9,.2,1) forwards';
        }, delay + 180);
      });
    })();

    // 2) Parallax tilt based on pointer/mouse for hero right area
    (function heroParallax(){
      const stack = document.getElementById('cardStack');
      if(!stack) return;
      const parent = stack.parentElement;
      parent.addEventListener('mousemove', (e) => {
        const rect = parent.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        const cards = stack.querySelectorAll('.photo-card');
        cards.forEach((card, idx) => {
          const depth = (idx - 1) * 8; // front card moves more
          const rx = y * 8 + depth;
          const ry = x * 14 + depth;
          const tz = 6 + (idx * 6);
          card.style.transform = `translateZ(${tz}px) rotateX(${rx}deg) rotateY(${ry}deg)`;
          const img = card.querySelector('img');
          if(img) img.style.transform = `scale(1.06) translate(${ -x * 6 * (idx+1) }px, ${ -y * 4 * (idx+1) }px)`;
        });
      });
      parent.addEventListener('mouseleave', () => {
        const cards = stack.querySelectorAll('.photo-card');
        cards.forEach((card, idx) => {
          // revert to original class transforms (c0,c1,c2)
          card.style.transform = '';
          const img = card.querySelector('img');
          if(img) img.style.transform = '';
        });
      });
    })();

    // 3) IntersectionObserver for scroll reveal of .from-left/.from-right/reveal/feature-card
    (function scrollReveal(){
      const io = new IntersectionObserver((entries)=>{
        entries.forEach(entry=>{
          if(entry.isIntersecting){
            entry.target.classList.add('in');
            // if it's a reveal text, also add .in class after tiny delay
            entry.target.classList.add('in'); 
            io.unobserve(entry.target);
          }
        });
      }, { root:null, rootMargin:'0px 0px -10% 0px', threshold:0.12 });

      // target groups
      const lefts = document.querySelectorAll('.from-left');
      const rights = document.querySelectorAll('.from-right');
      const reveals = document.querySelectorAll('.reveal');
      const features = document.querySelectorAll('.feature-card');

      lefts.forEach(el=>io.observe(el));
      rights.forEach(el=>io.observe(el));
      reveals.forEach(el=>io.observe(el));
      // stagger features with delay using data-i
      features.forEach((el,i)=>{
        el.style.transitionDelay = (i*90) + 'ms';
        io.observe(el);
      });

      // features in grid: when observed add class 'in' to animate
      const featureGrid = document.getElementById('featuresGrid');
      if(featureGrid){
        const cards = featureGrid.querySelectorAll('.feature-card');
        cards.forEach((card, i) => {
          card.classList.add('feature-card'); // ensure class present
          card.setAttribute('data-i', i);
        });
      }
    })();

    // 4) Subtle auto-animate headline gradient by toggling a CSS variable (optional)
    (function headlineGradient(){
      const headline = document.querySelector('.headline');
      if(!headline) return;
      // add a slow pulse by toggling a CSS transform using requestAnimationFrame loop
      let t = 0;
      function step(){
        t += 0.004;
        const skew = Math.sin(t) * 0.6;
        headline.style.transform = `rotateZ(${skew}deg)`;
        requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    })();

    // 5) Smooth scroll for internal anchors (native but ensure behavior)
    document.querySelectorAll('a[href^="#"], button[onclick]').forEach(el=>{
      el.addEventListener('click', (e)=>{
        // allow existing handlers, but ensure smooth scroll when target is an element id
        const href = el.getAttribute('href');
        const onclick = el.getAttribute('onclick') || '';
        if(href && href.startsWith('#')){
          const target = document.querySelector(href);
          if(target){ e.preventDefault(); target.scrollIntoView({behavior:'smooth'}); }
        } else if(onclick.includes("scrollIntoView")) {
          // let the inline handler execute
        }
      });
    });
  </script>
</body>
</html>
