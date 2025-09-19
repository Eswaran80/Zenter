<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Premium Task & Project Dashboard</title>

<style>
  :root{
    --bg-1:#f4f7fd;
    --glass: rgba(255,255,255,0.65);
    --accent1:#6C63FF;
    --accent2:#00C9A7;
    --muted:#7b8896;
    --card-shadow: 0 10px 30px rgba(18,24,40,0.08);
    --glass-strong: rgba(255,255,255,0.85);
  }

  /* Page baseline (we keep your dark gradient in previous drafts but final dashboard uses light cards) */
  html,body{height:100%;margin:0;font-family: "Segoe UI", Roboto, system-ui, -apple-system, "Helvetica Neue", Arial;}
  body{background: linear-gradient(180deg,#eaf1ff 0%, #f7fbff 100%); color:#17202a; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale;}

  /* Ensure sidebar exists separately; offset main-content to match sidebar width (200px) and top header 60px */
  .main-content {
    margin-left:200px;
    padding: 90px 40px 60px 40px;
    min-height: 3000vh; /* LONG PAGE */
  }
  @media(max-width:768px){
    .main-content{ margin-left:55px; padding:100px 18px; }
  }

  /* Large container card */
  .dashboard-wrap{
    max-width:1280px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr;
    gap: 34px;
  }

  /* HERO / SEARCH */
  .hero {
    background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.85));
    border-radius: 20px;
    padding: 28px 30px;
    box-shadow: var(--card-shadow);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    position: relative;
    overflow: hidden;
  }
  .hero::before{
    content:"";
    position:absolute; right:-120px; top:-40px; width:340px; height:340px;
    background: radial-gradient(circle at 30% 30%, rgba(108,99,255,0.12), transparent 30%),
                radial-gradient(circle at 70% 70%, rgba(0,201,167,0.10), transparent 30%);
    filter: blur(20px);
    transform: rotate(15deg);
  }
  .hero-left{
    display:flex; flex-direction:column; gap:8px;
  }
  .greeting{
    font-size:28px; font-weight:700; color:#0f1724; letter-spacing:0.2px;
    text-shadow: 0 6px 14px rgba(0,0,0,0.06);
  }
  .hero-sub{
    color:var(--muted); font-size:14px;
  }

  .hero-actions{ display:flex; gap:12px; align-items:center; }
  .search {
    background: #fff; border-radius:12px; padding:10px 14px; display:flex; align-items:center; gap:10px;
    min-width:420px; box-shadow: 0 6px 22px rgba(8,16,40,0.06);
    border: 1px solid rgba(16,24,40,0.04);
  }
  .search input{ border: none; outline:none; font-size:14px; width:100%; background:transparent; color:#17202a; }
  .btn-primary{
    background: linear-gradient(90deg,var(--accent1), var(--accent2)); color:#fff; border:none; padding:12px 16px; border-radius:12px; font-weight:700;
    box-shadow: 0 8px 24px rgba(102,103,255,0.14); cursor:pointer;
    transition: transform .15s ease, box-shadow .15s ease;
  }
  .btn-primary:hover{ transform: translateY(-3px); box-shadow: 0 18px 40px rgba(108,99,255,0.16); }

  /* Quick stats */
  .stats {
    display:grid;
    grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
    gap:18px;
  }
  .stat-card {
    background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(255,255,255,0.92));
    border-radius:14px;
    padding:18px;
    box-shadow: var(--card-shadow);
    display:flex; align-items:center; gap:12px;
    border-left:6px solid transparent;
    transition: transform .2s ease;
  }
  .stat-card:hover{ transform: translateY(-6px); }
  .stat-icon{
    width:56px; height:56px; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700;
    background: linear-gradient(135deg,var(--accent1), var(--accent2));
    box-shadow: 0 8px 22px rgba(108,99,255,0.12);
    flex-shrink:0;
  }
  .stat-body{ display:flex; flex-direction:column; }
  .stat-value { font-size:20px; font-weight:800; color:#0f1724; }
  .stat-label { font-size:13px; color:var(--muted); margin-top:4px; }

  /* Board + right column layout */
  .mid-grid{ display:grid; grid-template-columns: 2fr 1fr; gap:24px; align-items:start; }
  @media(max-width:1024px){ .mid-grid{ grid-template-columns: 1fr; } }

  /* KANBAN BOARD */
  .board {
    display:flex; gap:14px; align-items:start;
    overflow:visible;
  }
  .column {
    background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(255,255,255,0.9));
    border-radius:12px; padding:14px; min-width:260px; box-shadow: var(--card-shadow);
    display:flex; flex-direction:column; gap:12px;
  }
  .col-head{ display:flex; justify-content:space-between; align-items:center; margin-bottom:6px; }
  .col-title{ font-weight:700; color:#17202a; }
  .col-count{ font-size:13px; color:var(--muted); }

  .task-card {
    background:#fff; border-radius:12px; padding:12px; box-shadow: 0 6px 18px rgba(16,24,40,0.06);
    transition: transform .18s ease, box-shadow .18s ease;
    border-left:6px solid rgba(0,0,0,0.02);
  }
  .task-card:hover{ transform: translateY(-6px); box-shadow: 0 18px 32px rgba(16,24,40,0.08); }
  .task-title{ font-weight:700; color:#111827; margin-bottom:6px; }
  .task-meta{ font-size:13px; color:var(--muted); display:flex; gap:10px; align-items:center; margin-bottom:10px; }
  .avatars{ display:flex; gap:6px; align-items:center; }
  .avatar{
    width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700;
    box-shadow: 0 6px 12px rgba(16,24,40,0.08);
    font-size:13px;
  }
  .pill { padding:6px 10px; border-radius:999px; font-weight:700; font-size:12px; }

  .pill.progress{ background: linear-gradient(90deg,var(--accent1), var(--accent2)); color:#fff; }
  .pill.pending{ background:#fff6e8; color:#b35700; border:1px solid rgba(0,0,0,0.02); }
  .pill.done{ background:#e8fff3; color:#166534; border:1px solid rgba(0,0,0,0.02); }

  /* Right column (timeline / upcoming) */
  .right-column { display:flex; flex-direction:column; gap:18px; }
  .upcoming, .team-card { background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(255,255,255,0.9)); border-radius:12px; padding:14px; box-shadow: var(--card-shadow); }
  .upcoming h4, .team-card h4{ margin:0 0 12px 0; font-size:16px; color:#17202a; }

  /* Table - detailed tasks */
  .table-card{ background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(255,255,255,0.96)); padding:18px; border-radius:14px; box-shadow: var(--card-shadow); overflow:auto; }
  table.tasks {
    width:100%; border-collapse: collapse; min-width:920px; font-size:14px;
  }
  table.tasks thead th {
    text-align:left; font-size:12px; color:var(--muted); padding:10px 12px; text-transform:uppercase; letter-spacing:0.8px;
    border-bottom:1px solid rgba(16,24,40,0.04);
  }
  table.tasks tbody td{
    padding:14px 12px; vertical-align:middle; border-bottom:1px solid rgba(16,24,40,0.03);
  }
  .progress {
    height:10px; background: linear-gradient(90deg,#eef4ff,#f6fff9); border-radius:999px; overflow:hidden; width:160px;
    box-shadow: inset 0 -2px 8px rgba(0,0,0,0.04);
  }
  .progress > i {
    display:block; height:100%; width:40%;
    background: linear-gradient(90deg,var(--accent1), var(--accent2));
    border-radius:999px; transform-origin:left; transition:width .6s cubic-bezier(.2,.8,.2,1);
  }

  /* Team avatars */
  .team-list{ display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
  .member {
    display:flex; gap:10px; align-items:center; padding:8px 12px; border-radius:10px; background: #fff; color:#111;
    box-shadow: 0 8px 22px rgba(16,24,40,0.04);
    min-width:190px;
  }
  .member .initial{
    width:44px; height:44px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800;
    font-size:15px;
  }
  .member .meta{ font-size:13px; color:#17202a; }
  .member .role{ font-size:12px; color:var(--muted); margin-top:3px; }

  /* Timeline items */
  .timeline-item{ display:flex; gap:12px; align-items:flex-start; margin-bottom:14px; }
  .timeline-dot{ width:10px; height:10px; border-radius:50%; margin-top:6px; box-shadow: 0 6px 14px rgba(16,24,40,0.06); }
  .timeline-content{ background:#fff; border-radius:10px; padding:10px 12px; box-shadow: 0 8px 20px rgba(16,24,40,0.04); min-width:220px; }
  .timeline-title{ font-weight:800; color:#111; margin-bottom:6px; }
  .timeline-meta{ color:var(--muted); font-size:13px; }

  /* Footer spacer for very long page look */
  .big-spacer{ height:1800px; opacity:0; }

  /* tiny responsive tweaks */
  @media(max-width:640px){
    .search{ min-width:180px; }
    .stat-card{ padding:14px; }
    .task-card{ padding:10px; }
    table.tasks{ min-width:700px; }
  }

  /* Mini animations for aesthetic (pure CSS) */
  .sparkle{
    position:absolute; right:20px; top:20px; width:80px; height:80px; background: conic-gradient(rgba(108,99,255,0.08), rgba(0,201,167,0.06));
    filter: blur(18px); border-radius:50%; pointer-events:none; opacity:0.9;
  }

</style>
</head>
<body>

<x-sidebar/>

<div class="main-content">
  <div class="dashboard-wrap">

    <!-- HERO -->
    <section class="hero" aria-label="Welcome">
      <div class="hero-left">
        <div class="greeting">Welcome back, Eswar 👋</div>
        <div class="hero-sub">Here’s your project & task overview. Focus on what matters — deadlines, blockers and progress.</div>
      </div>

      <div style="display:flex; align-items:center; gap:16px;">
        <div class="search" aria-hidden="true">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M21 21l-4.35-4.35" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round"/></svg>
          <input placeholder="Search tasks, projects or team members..." />
        </div>
        <button class="btn-primary">+ New Task</button>
      </div>
      <div class="sparkle" aria-hidden="true"></div>
    </section>

    <!-- Quick stats -->
    <section class="stats">
      <div class="stat-card">
        <div class="stat-icon" style="background:linear-gradient(135deg,var(--accent1), #7b6bff);">T</div>
        <div class="stat-body">
          <div class="stat-value">48</div>
          <div class="stat-label">Total Tasks</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon" style="background:linear-gradient(135deg,#19b6ff,#00C9A7);">P</div>
        <div class="stat-body">
          <div class="stat-value">14</div>
          <div class="stat-label">In Progress</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon" style="background:linear-gradient(135deg,#7ee7b8,#42d392);">C</div>
        <div class="stat-body">
          <div class="stat-value">26</div>
          <div class="stat-label">Completed</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon" style="background:linear-gradient(135deg,#ffd29b,#ff7b5a);">O</div>
        <div class="stat-body">
          <div class="stat-value">8</div>
          <div class="stat-label">Overdue</div>
        </div>
      </div>
    </section>

    <!-- Mid area: Board + Right column -->
    <div class="mid-grid">

      <!-- Kanban board -->
      <div>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
          <h3 style="margin:0; color:#0f1724;">Project Board</h3>
          <div style="color:var(--muted); font-size:13px;">Drag & drop in production (replace later with JS)</div>
        </div>

        <div class="board" role="list">
          <!-- To Do -->
          <div class="column" aria-label="To Do">
            <div class="col-head"><span class="col-title">To Do</span><span class="col-count">6</span></div>

            <div class="task-card">
              <div class="task-title">Create landing page hero</div>
              <div class="task-meta"><span class="pill pending">Design</span> • <span style="color:var(--muted)">Due: Sep 26</span></div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="avatars">
                  <div class="avatar" style="background:linear-gradient(135deg,#ff7eb6,#ff65a3)">A</div>
                  <div class="avatar" style="background:linear-gradient(135deg,#6C63FF,#00C9A7)">E</div>
                </div>
                <div style="font-size:13px;color:var(--muted)">Est: 6h</div>
              </div>
            </div>

            <div class="task-card">
              <div class="task-title">Define DB schema for tasks</div>
              <div class="task-meta"><span class="pill pending">Back-end</span> • <span style="color:var(--muted)">Due: Sep 27</span></div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="avatars">
                  <div class="avatar" style="background:linear-gradient(135deg,#8ad6ff,#6bb9ff)">R</div>
                </div>
                <div style="font-size:13px;color:var(--muted)">Est: 4h</div>
              </div>
            </div>

            <div class="task-card">
              <div class="task-title">Write API for task CRUD</div>
              <div class="task-meta"><span class="pill pending">API</span> • <span style="color:var(--muted)">Due: Sep 28</span></div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="avatars">
                  <div class="avatar" style="background:linear-gradient(135deg,#ffd29b,#ff7b5a)">J</div>
                  <div class="avatar" style="background:linear-gradient(135deg,#b6ffc8,#66e3a1)">S</div>
                </div>
                <div style="font-size:13px;color:var(--muted)">Est: 8h</div>
              </div>
            </div>
          </div>

          <!-- In Progress -->
          <div class="column" aria-label="In Progress">
            <div class="col-head"><span class="col-title">In Progress</span><span class="col-count">5</span></div>

            <div class="task-card">
              <div class="task-title">Integrate OAuth login</div>
              <div class="task-meta"><span class="pill progress">Auth</span> • <span style="color:var(--muted)">Started: Sep 18</span></div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="avatars">
                  <div class="avatar" style="background:linear-gradient(135deg,#6C63FF,#00C9A7)">S</div>
                </div>
                <div style="font-size:13px;color:var(--muted)">Progress: 60%</div>
              </div>
            </div>

            <div class="task-card">
              <div class="task-title">Payment gateway sandbox</div>
              <div class="task-meta"><span class="pill progress">Payments</span> • <span style="color:var(--muted)">Started: Sep 17</span></div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="avatars">
                  <div class="avatar" style="background:linear-gradient(135deg,#7ee7b8,#42d392)">K</div>
                </div>
                <div style="font-size:13px;color:var(--muted)">Progress: 25%</div>
              </div>
            </div>

            <div class="task-card">
              <div class="task-title">Improve dashboard performance</div>
              <div class="task-meta"><span class="pill progress">Performance</span> • <span style="color:var(--muted)">Started: Sep 16</span></div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="avatars">
                  <div class="avatar" style="background:linear-gradient(135deg,#ffd29b,#ff7b5a)">L</div>
                  <div class="avatar" style="background:linear-gradient(135deg,#6C63FF,#00C9A7)">M</div>
                </div>
                <div style="font-size:13px;color:var(--muted)">Progress: 48%</div>
              </div>
            </div>
          </div>

          <!-- Completed -->
          <div class="column" aria-label="Completed">
            <div class="col-head"><span class="col-title">Completed</span><span class="col-count">26</span></div>

            <div class="task-card" style="border-left:6px solid rgba(34,197,94,0.12);">
              <div class="task-title">Landing page polished</div>
              <div class="task-meta"><span class="pill done">Design</span> • <span style="color:var(--muted)">Completed: Sep 15</span></div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="avatars">
                  <div class="avatar" style="background:linear-gradient(135deg,#b6ffc8,#66e3a1)">A</div>
                </div>
                <div style="font-size:13px;color:var(--muted)">Time: 10h</div>
              </div>
            </div>

            <div class="task-card" style="border-left:6px solid rgba(34,197,94,0.12);">
              <div class="task-title">User profile page</div>
              <div class="task-meta"><span class="pill done">Frontend</span> • <span style="color:var(--muted)">Completed: Sep 12</span></div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="avatars">
                  <div class="avatar" style="background:linear-gradient(135deg,#6C63FF,#00C9A7)">R</div>
                </div>
                <div style="font-size:13px;color:var(--muted)">Time: 6h</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right column -->
      <aside class="right-column">
        <div class="upcoming">
          <h4>Upcoming Deadlines</h4>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:linear-gradient(135deg,var(--accent1),var(--accent2));"></div>
            <div class="timeline-content">
              <div class="timeline-title">Payment gateway - Go Live</div>
              <div class="timeline-meta">Due: 2025-09-30 • Assigned: John</div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:#ffb86b;"></div>
            <div class="timeline-content">
              <div class="timeline-title">Final QA</div>
              <div class="timeline-meta">Due: 2025-10-02 • Assigned: QA Team</div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:#f87171;"></div>
            <div class="timeline-content">
              <div class="timeline-title">Security audit</div>
              <div class="timeline-meta">Due: 2025-10-07 • Assigned: Rahul</div>
            </div>
          </div>
        </div>

        <div class="team-card">
          <h4>Team Overview</h4>
          <div class="team-list">
            <div class="member">
              <div class="initial" style="background:linear-gradient(135deg,#6C63FF,#00C9A7)">ES</div>
              <div class="meta">
                <div style="font-weight:800">Eswar</div>
                <div class="role">Product Owner</div>
              </div>
            </div>

            <div class="member">
              <div class="initial" style="background:linear-gradient(135deg,#ffd29b,#ff7b5a)">RA</div>
              <div class="meta">
                <div style="font-weight:800">Rahul</div>
                <div class="role">Backend Lead</div>
              </div>
            </div>

            <div class="member">
              <div class="initial" style="background:linear-gradient(135deg,#b6ffc8,#66e3a1)">AL</div>
              <div class="meta">
                <div style="font-weight:800">Alice</div>
                <div class="role">UI/UX Designer</div>
              </div>
            </div>

            <div class="member">
              <div class="initial" style="background:linear-gradient(135deg,#8ad6ff,#6bb9ff)">JO</div>
              <div class="meta">
                <div style="font-weight:800">John</div>
                <div class="role">Payments</div>
              </div>
            </div>
          </div>
        </div>

      </aside>
    </div>

    <!-- Detailed tasks table -->
    <section class="table-card" aria-label="Detailed tasks">
      <h3 style="margin:0 0 12px 0; color:#0f1724;">Detailed Tasks</h3>
      <table class="tasks" role="table" aria-label="Tasks table">
        <thead>
          <tr>
            <th>#</th>
            <th>Task</th>
            <th>Project</th>
            <th>Assignee</th>
            <th>Progress</th>
            <th>Priority</th>
            <th>Due</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>01</td>
            <td style="font-weight:700;color:#111827">Design UI for Dashboard</td>
            <td>Website Redesign</td>
            <td>
              <div style="display:flex;align-items:center;gap:10px;">
                <div class="initial" style="width:34px;height:34px;font-size:13px">AL</div>
                <div style="font-size:13px">Alice</div>
              </div>
            </td>
            <td>
              <div class="progress"><i style="width:60%"></i></div>
            </td>
            <td><span class="badge high">High</span></td>
            <td>2025-09-25</td>
            <td style="white-space:nowrap">
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#fff;color:#0b7dda;font-weight:700;margin-right:8px;">View</span>
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#6C63FF;color:#fff;font-weight:700;margin-right:8px;">Edit</span>
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#ff5252;color:#fff;font-weight:700;">Delete</span>
            </td>
          </tr>

          <tr>
            <td>02</td>
            <td style="font-weight:700;color:#111827">Fix Login Authentication</td>
            <td>Backend Security</td>
            <td>
              <div style="display:flex;align-items:center;gap:10px;">
                <div class="initial" style="width:34px;height:34px;font-size:13px">RA</div>
                <div style="font-size:13px">Rahul</div>
              </div>
            </td>
            <td><div class="progress"><i style="width:100%"></i></div></td>
            <td><span class="badge medium">Medium</span></td>
            <td>2025-09-18</td>
            <td style="white-space:nowrap">
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#fff;color:#0b7dda;font-weight:700;margin-right:8px;">View</span>
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#6C63FF;color:#fff;font-weight:700;margin-right:8px;">Edit</span>
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#ff5252;color:#fff;font-weight:700;">Delete</span>
            </td>
          </tr>

          <tr>
            <td>03</td>
            <td style="font-weight:700;color:#111827">Integrate Payment Gateway</td>
            <td>E-Commerce</td>
            <td>
              <div style="display:flex;align-items:center;gap:10px;">
                <div class="initial" style="width:34px;height:34px;font-size:13px">JO</div>
                <div style="font-size:13px">John</div>
              </div>
            </td>
            <td><div class="progress"><i style="width:25%"></i></div></td>
            <td><span class="badge high">High</span></td>
            <td>2025-09-30</td>
            <td style="white-space:nowrap">
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#fff;color:#0b7dda;font-weight:700;margin-right:8px;">View</span>
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#6C63FF;color:#fff;font-weight:700;margin-right:8px;">Edit</span>
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#ff5252;color:#fff;font-weight:700;">Delete</span>
            </td>
          </tr>

          <tr>
            <td>04</td>
            <td style="font-weight:700;color:#111827">Create API Documentation</td>
            <td>API Suite</td>
            <td>
              <div style="display:flex;align-items:center;gap:10px;">
                <div class="initial" style="width:34px;height:34px;font-size:13px">SO</div>
                <div style="font-size:13px">Sophia</div>
              </div>
            </td>
            <td><div class="progress"><i style="width:45%"></i></div></td>
            <td><span class="badge low">Low</span></td>
            <td>2025-10-05</td>
            <td style="white-space:nowrap">
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#fff;color:#0b7dda;font-weight:700;margin-right:8px;">View</span>
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#6C63FF;color:#fff;font-weight:700;margin-right:8px;">Edit</span>
              <span style="display:inline-block;padding:8px 12px;border-radius:10px;background:#ff5252;color:#fff;font-weight:700;">Delete</span>
            </td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- Extra dashboard sections to fill long page and create realistic workspace -->
    <section style="display:grid; grid-template-columns: repeat(auto-fit,minmax(280px,1fr)); gap:20px;">
      <div class="team-card">
        <h4>Team Goals (This Month)</h4>
        <ul style="margin:10px 0 0 0; padding-left:18px; color:var(--muted)">
          <li>Complete payment gateway integration</li>
          <li>Finish performance optimizations</li>
          <li>Security audit & fixes</li>
          <li>Design handoff for marketing pages</li>
        </ul>
      </div>

      <div class="team-card">
        <h4>Sprint Summary</h4>
        <div style="display:flex; flex-direction:column; gap:8px;">
          <div style="display:flex;justify-content:space-between;color:var(--muted);"><div>Sprint days left</div><div style="font-weight:800;color:#111">4</div></div>
          <div style="display:flex;justify-content:space-between;color:var(--muted);"><div>Stories</div><div style="font-weight:800;color:#111">12</div></div>
          <div style="display:flex;justify-content:space-between;color:var(--muted);"><div>Completed</div><div style="font-weight:800;color:#111">7</div></div>
          <div style="display:flex;justify-content:space-between;color:var(--muted);"><div>Velocity</div><div style="font-weight:800;color:#111">28 pts</div></div>
        </div>
      </div>

      <div class="team-card">
        <h4>Roadmap Milestones</h4>
        <ol style="margin:10px 0 0 18px; color:var(--muted)">
          <li>Alpha release - 2025-10-10</li>
          <li>Beta release - 2025-11-12</li>
          <li>Public launch - 2026-01-20</li>
        </ol>
      </div>

      <div class="team-card">
        <h4>Notes & Blockers</h4>
        <p style="color:var(--muted); margin:8px 0 0 0;">1) Need SSL keys for payment gateway sandbox. 2) Third-party rate limiting causing slow webhook tests.</p>
      </div>
    </section>

    <!-- filler big spacer to reach ~3000vh feel -->
    <div class="big-spacer" aria-hidden="true"></div>

  </div>
</div>

</body>
</html>
