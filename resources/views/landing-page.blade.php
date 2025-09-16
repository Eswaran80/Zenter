<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Zenter — Project & Task Management</title>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Montserrat:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- AOS for scroll reveals -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    :root{
      --bg-0: #071023;
      --bg-1: #0d1630;
      --panel: #0f1626;
      --muted: #9fb0c6;
      --text: #eaf3ff;
      --accent1: #4f46e5; /* indigo */
      --accent2: #06b6d4; /* cyan */
      --glass: rgba(255,255,255,0.03);
      --card-shadow: 0 18px 50px rgba(3,6,20,0.6);
      --radius: 14px;
      --max-width: 1200px;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background:
        radial-gradient(800px 400px at 10% 8%, rgba(79,70,229,0.06), transparent),
        radial-gradient(700px 360px at 90% 92%, rgba(6,182,212,0.04), transparent),
        linear-gradient(180deg, var(--bg-0) 0%, var(--bg-1) 100%);
      color:var(--text);
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      overflow-x:hidden;
      line-height:1.5;
    }
    a{color:inherit; text-decoration:none}
    .container{max-width:var(--max-width); margin:0 auto; padding:0 24px}

    /* ---------- Navbar ---------- */
    header {
      position:fixed; left:0; right:0; top:0; z-index:1200;
      background: linear-gradient(180deg, rgba(4,7,16,0.5), rgba(4,7,16,0.18));
      border-bottom:1px solid rgba(255,255,255,0.03);
      backdrop-filter: blur(8px) saturate(120%);
    }
    .nav { height:72px; display:flex; align-items:center; justify-content:space-between; gap:12px; }
    .brand { display:flex; gap:12px; align-items:center; font-family:"Montserrat"; font-weight:800; }
    .logo {
      width:44px; height:44px; border-radius:10px; display:inline-grid; place-items:center;
      background: linear-gradient(135deg,var(--accent1),var(--accent2)); color:white;
      font-weight:800; box-shadow: 0 8px 30px rgba(79,70,229,0.08);
    }
    .nav .links { display:flex; gap:18px; align-items:center; color:var(--muted); font-weight:600 }
    .nav .links a { padding:8px 10px; border-radius:8px; transition:all .16s ease; }
    .nav .links a:hover { color:var(--text); background: rgba(255,255,255,0.02) }

    .cta { display:flex; gap:10px; align-items:center }
    .btn { border: none; cursor:pointer; padding:10px 14px; border-radius:10px; font-weight:700; transition:transform .12s ease, box-shadow .12s ease; }
    .btn-ghost { background:transparent; color:var(--muted); border:1px solid rgba(255,255,255,0.03) }
    .btn-primary { background: linear-gradient(90deg,var(--accent1),var(--accent2)); color:white; box-shadow:0 12px 30px rgba(79,70,229,0.12) }
    .btn:active{ transform:translateY(1px) }

    @media (max-width:760px){
      .nav .links { display:none }
    }

    /* ---------- Hero ---------- */
    .hero { min-height:92vh; display:grid; grid-template-columns: 1fr 520px; gap:48px; align-items:center; padding-top:92px; padding-bottom:64px; }
    @media (max-width:1100px){ .hero{ grid-template-columns: 1fr; padding-top:120px; gap:28px } }

    .hero-left { max-width:760px; padding:12px 6px }
    .tag { display:inline-block; padding:8px 12px; border-radius:999px; background:rgba(6,182,212,0.08); color:var(--accent2); font-weight:700; margin-bottom:12px }
    .title { font-family:"Montserrat"; font-weight:800; font-size: clamp(34px, 5.5vw, 56px); color:var(--text); line-height:1.02; margin:0 0 12px 0; }
    .sub { color:var(--muted); font-size:1.05rem; margin-bottom:18px; max-width:680px }
    .hero-actions { display:flex; gap:14px; align-items:center; margin-top:8px }

    /* Typewriter small greeting */
    .greeting { font-weight:700; color:var(--accent2); margin-top:8px; display:flex; gap:10px; align-items:center }
    .type { font-family: "Inter"; font-weight:800; letter-spacing:0.4px; font-size:1.02rem }

    /* Right: stack */
    .hero-right { display:flex; align-items:center; justify-content:center; perspective:1600px; }
    .stack { width:480px; height:62vh; min-height:360px; position:relative; transform-style:preserve-3d; }
    .card {
      position:absolute; inset:0; border-radius:16px; overflow:hidden; padding:18px;
      border:1px solid rgba(255,255,255,0.04); background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      box-shadow: var(--card-shadow); transition: transform .45s cubic-bezier(.2,.9,.2,1), box-shadow .45s;
      display:flex; flex-direction:column; justify-content:flex-end; backface-visibility:hidden;
    }
    .card img{ position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:-1; filter:contrast(1.02) saturate(1.05) }
    .card.c0{ transform: translate3d(-18px,-8px,-40px) rotateZ(-4deg) }
    .card.c1{ transform: translate3d(6px,6px,-18px) rotateZ(1deg) scale(.99) }
    .card.c2{ transform: translate3d(26px,20px,0px) rotateZ(3.6deg) scale(.96) }
    .stack:hover .card{ transform: translateY(6px) scale(.998) }
    .stack .card:hover { transform: translateY(-18px) translateZ(48px) rotateX(6deg) rotateY(-6deg) scale(1.02); box-shadow:0 36px 80px rgba(2,6,23,0.8) }

    /* ---------- Sections ---------- */
    section.scroll { padding:80px 0; position:relative }
    .center { text-align:center }
    .title-small { font-weight:800; font-size: clamp(20px, 3vw, 30px); margin-bottom:8px; color:var(--text) }
    .subtitle { color:var(--muted); max-width:900px; margin:6px auto 24px }

    /* features grid */
    .grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-top:18px }
    @media (max-width:980px){ .grid-3{ grid-template-columns:repeat(2,1fr) } }
    @media (max-width:640px){ .grid-3{ grid-template-columns:1fr } }

    .feature {
      background: linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.00));
      border-radius:12px; padding:18px; border:1px solid rgba(255,255,255,0.03); box-shadow: 0 12px 28px rgba(2,6,23,0.45);
    }
    .feature .icon { width:56px; height:56px; border-radius:12px; display:inline-grid; place-items:center; background:linear-gradient(135deg,var(--accent1),var(--accent2)); color:white; font-weight:800; margin-bottom:12px }

    /* gallery */
    .gallery { display:flex; gap:18px; flex-wrap:wrap; justify-content:center; margin-top:18px }
    .shot { width:320px; height:220px; border-radius:12px; overflow:hidden; border:1px solid rgba(255,255,255,0.04); background:var(--panel); box-shadow:0 12px 30px rgba(2,6,23,0.5); transition:transform .35s ease }
    .shot img{ width:100%; height:100%; object-fit:cover }
    .shot:hover{ transform:translateY(-10px) scale(1.02) }

    /* pricing */
    .pricing { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-top:18px }
    @media (max-width:980px){ .pricing{ grid-template-columns:repeat(2,1fr) } }
    @media (max-width:640px){ .pricing{ grid-template-columns:1fr } }
    .plan { padding:20px; border-radius:12px; border:1px solid rgba(255,255,255,0.03); background:linear-gradient(180deg, rgba(255,255,255,0.01), transparent); box-shadow:0 10px 30px rgba(2,6,23,0.45) }

    /* team */
    .team { display:grid; grid-template-columns:repeat(4,1fr); gap:18px; margin-top:18px }
    @media (max-width:1000px){ .team{ grid-template-columns:repeat(2,1fr) } }
    @media (max-width:600px){ .team{ grid-template-columns:1fr } }
    .member { background:var(--panel); padding:16px; border-radius:12px; text-align:center; border:1px solid rgba(255,255,255,0.03) }

    /* testimonial */
    .testimonials { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-top:18px }
    @media (max-width:980px){ .testimonials{ grid-template-columns:repeat(2,1fr) } }
    @media (max-width:640px){ .testimonials{ grid-template-columns:1fr } }
    .testimonial { padding:18px; border-radius:12px; background: linear-gradient(180deg, rgba(255,255,255,0.01), transparent); border:1px solid rgba(255,255,255,0.03) }

    /* faq */
    .faq { max-width:880px; margin:0 auto; margin-top:18px }
    .qa { background:var(--panel); border-radius:10px; padding:14px; margin-bottom:10px; border:1px solid rgba(255,255,255,0.03) }

    /* contact */
    .contact-grid { display:grid; grid-template-columns:1fr 420px; gap:28px; margin-top:18px }
    @media (max-width:980px){ .contact-grid{ grid-template-columns:1fr } }
    .contact-card { background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); padding:18px; border-radius:12px; border:1px solid rgba(255,255,255,0.03) }
    input, textarea { width:100%; padding:12px; border-radius:10px; background:transparent; border:1px solid rgba(255,255,255,0.04); color:var(--text); margin-bottom:12px }
    input::placeholder, textarea::placeholder { color:rgba(255,255,255,0.4) }

    /* footer */
    footer { padding:48px 0 36px; border-top:1px solid rgba(255,255,255,0.03); margin-top:36px }
    .footer-grid { display:grid; grid-template-columns:1fr 1fr 1fr 320px; gap:20px; align-items:start }
    @media (max-width:980px){ .footer-grid{ grid-template-columns:1fr 1fr } }
    @media (max-width:560px){ .footer-grid{ grid-template-columns:1fr } }

    .socials { display:flex; gap:12px; margin-top:12px }
    .socials a { display:inline-flex; align-items:center; justify-content:center; width:44px; height:44px; border-radius:10px; background: linear-gradient(90deg,var(--accent1),var(--accent2)); color:white; box-shadow:0 12px 30px rgba(79,70,229,0.08) }

    .muted { color:var(--muted) }
    .center { text-align:center }
  </style>
</head>
<body>
  <!-- NAV -->
  <header>
    <div class="container nav">
      <div style="display:flex;align-items:center;gap:12px">
        <div class="brand" aria-hidden="true">
          <div class="logo">Z</div>
          <div>
            <div style="font-size:.98rem">Zenter</div>
            <small class="muted" style="font-size:.72rem">Tasks • Projects • Focus</small>
          </div>
        </div>
      </div>

      <nav class="links" aria-label="Main">
        <a href="#features">Features</a>
        <a href="#how">How it works</a>
        <a href="#demo">Demo</a>
        <a href="#screenshots">Screenshots</a>
        <a href="#pricing">Pricing</a>
        <a href="#team">Team</a>
        <a href="#contact">Contact</a>
      </nav>

      <div class="cta">
        <button class="btn btn-ghost" onclick="window.location='{{route('login')}}'">Login</button>
        <button class="btn btn-primary" onclick="scrollToSection('#pricing')">Get started</button>
      </div>
    </div>
  </header>

  <main>
    <!-- HERO -->
    <section class="hero container" id="home">
      <div class="hero-left" data-aos="fade-up">
        <div class="tag">Zenter • Project Management</div>
        <h1 class="title">Manage tasks, ship features, and keep teams in sync</h1>
        <p class="sub">Zenter helps teams plan work, stay focused with sprints and cycles, and deliver reliably — with a delightful, fast UI.</p>

        {{-- <div class="greeting">
          <div class="type" id="typewriter"></div>
        </div> --}}

        <div class="hero-actions">
          <button class="btn btn-primary" id="primaryCta">Start free trial</button>
          <button class="btn btn-ghost" onclick="scrollToSection('#demo')">Interactive demo</button>
        </div>

        <div style="display:flex;gap:12px;margin-top:16px;">
          <div style="background:var(--glass); padding:10px 12px; border-radius:10px; border:1px solid rgba(255,255,255,0.03)">
            <strong>For Teams</strong><div class="muted" style="font-weight:600">Scale from 1 → 100+</div>
          </div>
          <div style="background:var(--glass); padding:10px 12px; border-radius:10px; border:1px solid rgba(255,255,255,0.03)">
            <strong>Focus Mode</strong><div class="muted" style="font-weight:600">Deep work built-in</div>
          </div>
        </div>
      </div>

      <div class="hero-right" data-aos="zoom-in">
        <div class="stack" id="stack">
          <article class="card c0">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1600&auto=format&fit=crop" alt="kanban">
            <div style="display:flex;flex-direction:column;gap:8px;">
              <div style="display:flex;align-items:center;gap:8px">
                <div style="background:linear-gradient(90deg,var(--accent1),var(--accent2)); padding:8px 10px; border-radius:999px; color:white; font-weight:700">Sprint</div>
                <small class="muted">In progress • 8 tasks</small>
              </div>
              <small class="muted">Kanban • Board view</small>
            </div>
          </article>

          <article class="card c1">
            <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981d?q=80&w=1600&auto=format&fit=crop" alt="team work">
            <div style="display:flex;flex-direction:column;gap:8px;">
              <div style="display:flex;align-items:center;gap:8px">
                <div style="background:rgba(255,255,255,0.05); padding:8px 10px; border-radius:999px; color:white; font-weight:700">Planning</div>
                <small class="muted">Roadmap • Q3</small>
              </div>
              <small class="muted">Team sync • Notes</small>
            </div>
          </article>

          <article class="card c2">
            <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1600&auto=format&fit=crop" alt="dashboard">
            <div style="display:flex;flex-direction:column;gap:8px;">
              <div style="display:flex;align-items:center;gap:8px">
                <div style="background:linear-gradient(90deg,var(--accent2),var(--accent1)); padding:8px 10px; border-radius:999px; color:white; font-weight:700">Insights</div>
                <small class="muted">Velocity • Lead time</small>
              </div>
              <small class="muted">Reports & analytics</small>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="scroll">
      <div class="center" data-aos="fade-up">
        <div class="title-small">Core features</div>
        <p class="subtitle">Built to help teams plan, prioritize and deliver — with less friction and more focus.</p>
      </div>

      <div class="grid-3 container" data-aos="fade-up" data-aos-delay="60">
        <div class="feature">
          <div class="icon">🗂️</div>
          <h4>Boards & Kanban</h4>
          <p class="muted">Flexible boards for workflows, with drag & drop and quick actions.</p>
        </div>

        <div class="feature">
          <div class="icon">🧭</div>
          <h4>Roadmaps</h4>
          <p class="muted">Plan releases, track objectives, and align your team.</p>
        </div>

        <div class="feature">
          <div class="icon">⏱️</div>
          <h4>Sprints & Focus Mode</h4>
          <p class="muted">Run time-boxed sprints and help teammates enter deep work.</p>
        </div>

        <div class="feature">
          <div class="icon">📅</div>
          <h4>Calendar & Deadlines</h4>
          <p class="muted">Calendar integration, reminders and due-date automation.</p>
        </div>

        <div class="feature">
          <div class="icon">🔗</div>
          <h4>Integrations</h4>
          <p class="muted">Connect Git, Slack, calendars, and many more tools.</p>
        </div>

        <div class="feature">
          <div class="icon">📊</div>
          <h4>Analytics</h4>
          <p class="muted">Velocity, cycle time and actionable team metrics.</p>
        </div>
      </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how" class="scroll">
      <div class="split container" style="align-items:center">
        <div data-aos="fade-right">
          <div class="title-small">How Zenter works</div>
          <p class="subtitle">A simple workflow: plan → assign → focus → ship. Everything is designed to keep attention on the work that matters.</p>

          <ol style="color:var(--muted); margin-top:14px; max-width:560px">
            <li style="margin-bottom:10px"><strong>Create projects & templates</strong> — standardize recurring work.</li>
            <li style="margin-bottom:10px"><strong>Assign & prioritize</strong> — auto-priorities and due dates sync across teams.</li>
            <li style="margin-bottom:10px"><strong>Run sprints</strong> — focus mode and paired work to ship faster.</li>
          </ol>
        </div>

        <div class="media" data-aos="fade-left">
          <div style="border-radius:12px; overflow:hidden; border:1px solid rgba(255,255,255,0.04); box-shadow:0 20px 50px rgba(2,6,23,0.45)">
            <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=1400&auto=format&fit=crop" alt="workflow" style="width:560px; height:360px; object-fit:cover; display:block">
          </div>
        </div>
      </div>
    </section>

    <!-- DEMO -->
    <section id="demo" class="scroll">
      <div class="center" data-aos="fade-up">
        <div class="title-small">Interactive demo</div>
        <p class="subtitle">Hover the stack on the right to see subtle parallax & 3D depth. Try the buttons to experience motion and focus features.</p>
      </div>

      <div style="display:flex; justify-content:center; margin-top:20px;">
        <div style="width:880px; display:grid; grid-template-columns:1fr 1fr; gap:18px">
          <div class="shot" data-aos="zoom-in">
            <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=1200&auto=format&fit=crop" alt="kanban shot">
          </div>
          <div class="shot" data-aos="zoom-in" data-aos-delay="80">
            <img src="https://images.unsplash.com/photo-1520975913340-2a4b46a3c2b0?q=80&w=1200&auto=format&fit=crop" alt="calendar shot">
          </div>
          <div class="shot" data-aos="zoom-in" data-aos-delay="160">
            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200&auto=format&fit=crop" alt="team shot">
          </div>
          <div class="shot" data-aos="zoom-in" data-aos-delay="240">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=1200&auto=format&fit=crop" alt="dashboard shot">
          </div>
        </div>
      </div>
    </section>

    <!-- SCREENSHOTS -->
    <section id="screenshots" class="scroll">
      <div class="center" data-aos="fade-up">
        <div class="title-small">Screenshots</div>
        <p class="subtitle">Some views from the app — board, calendar, and insights.</p>
      </div>

      <div class="gallery" data-aos="fade-up">
        <div class="shot"><img src="https://images.unsplash.com/photo-1555949963-aa79dcee981d?q=80&w=1200&auto=format&fit=crop" alt="s1"></div>
        <div class="shot"><img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop" alt="s2"></div>
        <div class="shot"><img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1200&auto=format&fit=crop" alt="s3"></div>
      </div>
    </section>

    <!-- PRICING -->
    <section id="pricing" class="scroll">
      <div class="center" data-aos="fade-up">
        <div class="title-small">Pricing</div>
        <p class="subtitle">Simple, transparent plans that scale with teams.</p>
      </div>

      <div class="pricing container" data-aos="fade-up" data-aos-delay="60">
        <div class="plan">
          <h3 style="margin:0 0 8px 0">Starter</h3>
          <p class="muted">Free • Small teams</p>
          <div style="font-weight:800; font-size:1.5rem; margin:10px 0">₹0 / mo</div>
          <ul style="color:var(--muted)">
            <li>Unlimited tasks</li>
            <li>Boards & Calendar</li>
            <li>Email support</li>
          </ul>
          <div style="margin-top:14px"><button class="btn btn-primary">Start free</button></div>
        </div>

        <div class="plan" style="transform:scale(1.02); border:1px solid rgba(79,70,229,0.12); box-shadow:0 16px 50px rgba(79,70,229,0.06)">
          <h3 style="margin:0 0 8px 0">Pro</h3>
          <p class="muted">Best for teams</p>
          <div style="font-weight:800; font-size:1.5rem; margin:10px 0">₹699 / mo</div>
          <ul style="color:var(--muted)">
            <li>Advanced analytics</li>
            <li>Sprints & focus mode</li>
            <li>Priority support</li>
          </ul>
          <div style="margin-top:14px"><button class="btn btn-primary">Get Pro</button></div>
        </div>

        <div class="plan">
          <h3 style="margin:0 0 8px 0">Enterprise</h3>
          <p class="muted">Custom</p>
          <div style="font-weight:800; font-size:1.5rem; margin:10px 0">Contact</div>
          <ul style="color:var(--muted)">
            <li>SSO & SAML</li>
            <li>Dedicated support</li>
            <li>Custom integrations</li>
          </ul>
          <div style="margin-top:14px"><button class="btn btn-ghost" onclick="scrollToSection('#contact')">Contact Sales</button></div>
        </div>
      </div>
    </section>

    <!-- TEAM -->
    <section id="team" class="scroll">
      <div class="center" data-aos="fade-up">
        <div class="title-small">Team</div>
        <p class="subtitle">People building Zenter with care.</p>
      </div>

      <div class="team container" data-aos="fade-up" data-aos-delay="60">
        <div class="member"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="" style="width:84px;height:84px;border-radius:999px"><div style="font-weight:700;margin-top:8px">Ravi</div><small class="muted">Founder</small></div>
        <div class="member"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="" style="width:84px;height:84px;border-radius:999px"><div style="font-weight:700;margin-top:8px">Priya</div><small class="muted">Product</small></div>
        <div class="member"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="" style="width:84px;height:84px;border-radius:999px"><div style="font-weight:700;margin-top:8px">Arjun</div><small class="muted">Engineering</small></div>
        <div class="member"><img src="https://randomuser.me/api/portraits/women/47.jpg" alt="" style="width:84px;height:84px;border-radius:999px"><div style="font-weight:700;margin-top:8px">Meera</div><small class="muted">Design</small></div>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section id="testimonials" class="scroll">
      <div class="center" data-aos="fade-up">
        <div class="title-small">Testimonials</div>
        <p class="subtitle">Trusted by product teams and agencies.</p>
      </div>

      <div class="testimonials container" data-aos="fade-up">
        <div class="testimonial">“Zenter made our planning predictable — we ship more.”<div style="font-weight:700;margin-top:8px">— Kiran, PM</div></div>
        <div class="testimonial">“Focus Mode helped our engineers deep work without context switching.”<div style="font-weight:700;margin-top:8px">— Sanya, Eng</div></div>
        <div class="testimonial">“Intuitive boards and reports — onboarding is a breeze.”<div style="font-weight:700;margin-top:8px">— Amit, Ops</div></div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="scroll">
      <div class="center" data-aos="fade-up">
        <div class="title-small">FAQ</div>
        <p class="subtitle">Short answers to common questions.</p>
      </div>

      <div class="faq" data-aos="fade-up">
        <div class="qa"><strong>Is there a trial?</strong><div class="muted" style="margin-top:6px">Yes — 14 day free trial for Pro features.</div></div>
        <div class="qa"><strong>Does Zenter integrate with Slack?</strong><div class="muted" style="margin-top:6px">Yes — notifications, reminders and quick commands available.</div></div>
        <div class="qa"><strong>Can I import data?</strong><div class="muted" style="margin-top:6px">CSV import and migration support for paid plans.</div></div>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="scroll">
      <div class="center" data-aos="fade-up">
        <div class="title-small">Contact</div>
        <p class="subtitle">Questions, demo requests, or partnerships — we’re here to help.</p>
      </div>

      <div class="contact-grid container" data-aos="fade-up">
        <div>
          <form class="contact-card" onsubmit="event.preventDefault(); alert('Thanks — we will reach out shortly!')">
            <input placeholder="Your name" required>
            <input type="email" placeholder="Email" required>
            <input placeholder="Company (optional)">
            <textarea rows="5" placeholder="How can we help?"></textarea>
            <div style="display:flex;gap:10px;align-items:center">
              <button class="btn btn-primary" type="submit">Send message</button>
              <button class="btn btn-ghost" type="button" onclick="scrollToSection('#primaryCta')">Request demo</button>
            </div>
          </form>
        </div>

        <div class="contact-card" style="display:flex;flex-direction:column;gap:12px;justify-content:center">
          <div>
            <h4 style="margin:0">Office</h4>
            <p class="muted">hello@zenter.example<br>+91 99999 99999</p>
          </div>

          <div>
            <strong>Follow us</strong>
            <div class="socials" style="margin-top:8px">
              <a href="#" aria-label="instagram"><i class="fab fa-instagram"></i></a>
              <a href="#" aria-label="youtube"><i class="fab fa-youtube"></i></a>
              <a href="#" aria-label="facebook"><i class="fab fa-facebook"></i></a>
              <a href="#" aria-label="twitter"><i class="fab fa-twitter"></i></a>
            </div>
          </div>

          <div>
            <strong>Quick links</strong>
            <ul style="list-style:none;padding:0;margin:8px 0 0;color:var(--muted)">
              <li>Docs</li><li>Changelog</li><li>Privacy</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <div class="container footer-grid">
        <div>
          <h4 style="margin:0 0 8px 0">Zenter</h4>
          <p class="muted" style="max-width:320px">A fast, collaborative project & task management tool built for teams who ship.</p>
          <div style="margin-top:12px">
            <button class="btn btn-primary">Start free trial</button>
            <button class="btn btn-ghost" style="margin-left:8px">Contact sales</button>
          </div>
        </div>

        <div>
          <h5 style="margin-bottom:8px">Product</h5>
          <ul style="list-style:none;padding:0;margin:0;color:var(--muted)">
            <li>Features</li><li>Integrations</li><li>Pricing</li><li>Docs</li>
          </ul>
        </div>

        <div>
          <h5 style="margin-bottom:8px">Company</h5>
          <ul style="list-style:none;padding:0;margin:0;color:var(--muted)">
            <li>About</li><li>Careers</li><li>Press</li><li>Legal</li>
          </ul>
        </div>

        <div>
          <h5 style="margin-bottom:8px">Subscribe</h5>
          <div style="display:flex;gap:8px">
            <input placeholder="Your email" style="padding:10px 12px;border-radius:10px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:var(--text)">
            <button class="btn btn-primary">Subscribe</button>
          </div>

          <div style="margin-top:12px">
            <div class="socials">
              <a href="#" aria-label="instagram"><i class="fab fa-instagram"></i></a>
              <a href="#" aria-label="youtube"><i class="fab fa-youtube"></i></a>
              <a href="#" aria-label="facebook"><i class="fab fa-facebook"></i></a>
              <a href="#" aria-label="twitter"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="container" style="margin-top:20px">
        <div class="center muted">© <span id="yr"></span> Zenter • Crafted with ♥</div>
      </div>
    </footer>
  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration:900, easing:'ease-out-quart', once:true });

    // year
    document.getElementById('yr').textContent = new Date().getFullYear();

    // typewriter greeting (cycles a few messages)
    (function typeWriter(){
      const el = document.getElementById('typewriter');
      const messages = ['Welcome, product teams.', 'Plan better. Ship faster.', 'Focus on what matters.'];
      let idx = 0, char = 0, forward = true, delay = 60;
      function step(){
        const msg = messages[idx];
        if(forward){
          char++;
          el.textContent = msg.slice(0,char);
          if(char === msg.length){ forward = false; setTimeout(step, 900); return; }
        } else {
          char--;
          el.textContent = msg.slice(0,char);
          if(char === 0){ forward = true; idx = (idx+1) % messages.length; setTimeout(step, 300); return; }
        }
        setTimeout(step, delay);
      }
      step();
    })();

    // subtle tilt for stack
    (function tiltStack(){
      const stack = document.getElementById('stack');
      if(!stack) return;
      const cards = stack.querySelectorAll('.card');
      stack.addEventListener('mousemove', e => {
        const rect = stack.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        cards.forEach((card, i) => {
          const depth = (i - 1) * 8;
          const rx = y * 8 + depth;
          const ry = x * 12 + depth;
          const tz = 6 + (i * 6);
          card.style.transform = `translateZ(${tz}px) rotateX(${rx}deg) rotateY(${ry}deg)`;
          const img = card.querySelector('img');
          if(img) img.style.transform = `scale(1.06) translate(${ -x * 6 * (i+1) }px, ${ -y * 4 * (i+1) }px)`;
        });
      });
      stack.addEventListener('mouseleave', ()=> {
        cards.forEach(c => { c.style.transform = ''; const img = c.querySelector('img'); if(img) img.style.transform = '';});
      });
    })();

    // smooth scroll helper
    function scrollToSection(id){
      const el = document.querySelector(id);
      if(el) el.scrollIntoView({behavior:'smooth', block:'start'});
    }

    // nav links smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a=>{
      a.addEventListener('click', e=>{
        e.preventDefault();
        const target = document.querySelector(a.getAttribute('href'));
        if(target) target.scrollIntoView({behavior:'smooth', block:'start'});
      });
    });
  </script>
</body>
</html>
