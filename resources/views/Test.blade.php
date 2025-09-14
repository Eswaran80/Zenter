<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Premium User Management — Zenter</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
  <style>
    :root{
      --bg-1: #0f1724; /* deep navy */
      --accent-1: #7c5cff; /* violet */
      --accent-2: #00d4ff; /* aqua */
      --glass: rgba(255,255,255,0.06);
      --glass-2: rgba(255,255,255,0.04);
      --soft: rgba(255,255,255,0.06);
      --muted: rgba(255,255,255,0.65);
      --glass-border: rgba(255,255,255,0.08);
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      background: radial-gradient(1000px 500px at 10% 10%, rgba(124,92,255,0.12), transparent),
                  radial-gradient(600px 400px at 90% 90%, rgba(0,212,255,0.06), transparent),
                  var(--bg-1);
      color:#eaf0ff;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      overflow:hidden;
    }

    /* Canvas background (animated subtle particles) */
    #bgCanvas{position:fixed;inset:0;z-index:0;pointer-events:none}

    /* App container */
    .app{
      position:relative;z-index:2;max-width:1200px;margin:40px auto;padding:28px;display:grid;grid-template-columns:360px 1fr;gap:28px;
      transform-style:preserve-3d;perspective:1200px;
    }

    /* Sidebar */
    .sidebar{
      background:linear-gradient(180deg,var(--glass), transparent);
      border:1px solid var(--glass-border);
      border-radius:18px;padding:20px;backdrop-filter: blur(8px);
      box-shadow: 0 8px 30px rgba(2,6,23,0.6);
      min-height:640px;display:flex;flex-direction:column;gap:14px;
      transform:translateZ(40px) rotateY(-6deg);
    }
    .brand{display:flex;align-items:center;gap:12px}
    .logo{width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,var(--accent-1),var(--accent-2));display:flex;align-items:center;justify-content:center;font-weight:800;color:white;font-size:20px;box-shadow:0 6px 18px rgba(124,92,255,0.18)}
    h1{margin:0;font-size:18px}
    .muted{color:var(--muted);font-weight:500;font-size:13px}

    .nav{display:flex;flex-direction:column;gap:8px;margin-top:6px}
    .nav a{display:flex;align-items:center;gap:10px;padding:10px;border-radius:10px;color:inherit;text-decoration:none;font-weight:600}
    .nav a:hover{background:linear-gradient(90deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));transform:translateX(6px)}

    /* Main panel */
    .panel{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
      border-radius:18px;padding:24px;border:1px solid var(--glass-border);min-height:640px;backdrop-filter: blur(8px);
      box-shadow: 0 12px 40px rgba(2,6,23,0.6);
      transform:translateZ(0px);
    }

    /* Header */
    .panel-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
    .search{display:flex;align-items:center;gap:10px;background:var(--glass);padding:8px 12px;border-radius:999px;border:1px solid var(--glass-border);width:420px}
    .search input{background:transparent;border:0;outline:none;color:inherit;font-weight:600}

    .controls{display:flex;align-items:center;gap:12px}
    .btn{padding:10px 14px;border-radius:10px;border:0;background:linear-gradient(90deg,var(--accent-1),var(--accent-2));color:#071024;font-weight:700;cursor:pointer;box-shadow:0 8px 18px rgba(124,92,255,0.14);}
    .ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:8px 10px;border-radius:10px}

    /* Cards */
    .stats{display:flex;gap:12px}
    .stat{flex:1;padding:16px;border-radius:12px;background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));border:1px solid var(--glass-border);}
    .stat h3{margin:0;font-size:13px;color:var(--muted)}
    .stat p{margin:8px 0 0;font-size:20px;font-weight:800}

    /* Table */
    .table-wrap{margin-top:18px;background:linear-gradient(180deg, rgba(255,255,255,0.01), transparent);border-radius:12px;padding:12px;border:1px solid rgba(255,255,255,0.03)}
    table{width:100%;border-collapse:collapse;font-size:14px}
    thead th{ text-align:left;padding:12px 10px;color:var(--muted);font-weight:700; font-size:12px}
    tbody tr{transition:transform .28s cubic-bezier(.2,.9,.2,1), box-shadow .28s; cursor:grab}
    tbody tr:hover{transform:translateY(-6px) scale(1.01);box-shadow: 0 12px 30px rgba(2,6,23,0.6)}
    td{padding:12px 10px;vertical-align:middle;border-top:1px solid rgba(255,255,255,0.02)}

    .avatar{width:44px;height:44px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;font-weight:700;color:#071024}
    .role{font-weight:700;padding:6px 8px;border-radius:999px;font-size:12px}

    /* Toggle */
    .switch{width:46px;height:26px;background:rgba(255,255,255,0.06);border-radius:999px;display:inline-block;position:relative;padding:3px}
    .switch span{position:absolute;left:3px;top:3px;width:20px;height:20px;border-radius:50%;background:white;transition:all .25s}
    .switch.on{background:linear-gradient(90deg,var(--accent-1),var(--accent-2))}
    .switch.on span{transform:translateX(20px)}

    /* Modal / Drawer */
    .modal{position:fixed;inset:0;display:flex;align-items:flex-end;justify-content:center;padding:40px;z-index:9;pointer-events:none}
    .modal .window{width:640px;background:linear-gradient(180deg,#0c1220, rgba(255,255,255,0.02));border-radius:14px;padding:18px;border:1px solid var(--glass-border);backdrop-filter: blur(8px);pointer-events:auto;transform:translateY(40px);opacity:0;transition:all .28s}
    .modal.show .window{transform:translateY(0);opacity:1}

    /* Form */
    label{display:block;font-weight:600;margin-bottom:6px}
    .row{display:flex;gap:10px}
    input,select{padding:12px;border-radius:8px;background:transparent;border:1px solid rgba(255,255,255,0.04);outline:none;color:inherit}

    /* 3D Card preview */
    .preview{
      width:220px;height:120px;border-radius:14px;padding:12px;background:linear-gradient(135deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));border:1px solid rgba(255,255,255,0.03);display:flex;flex-direction:column;justify-content:center;gap:6px;transform-style:preserve-3d;transition:transform .18s ease-out
    }

    /* responsive */
    @media (max-width:1000px){
      .app{grid-template-columns:1fr;max-width:900px;padding:18px;margin:18px}
      .sidebar{transform:none}
    }
  </style>
</head>
<body>
  <canvas id="bgCanvas"></canvas>
  <div class="app">
    <aside class="sidebar" aria-label="left sidebar">
      <div class="brand">
        <div class="logo">Zz</div>
        <div>
          <h1>Zenter</h1>
          <div class="muted">User Management</div>
        </div>
      </div>

      <nav class="nav">
        <a href="#"><i class="ri-dashboard-line"></i> Dashboard</a>
        <a href="#" style="background:linear-gradient(90deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));"><i class="ri-user-settings-line"></i> Users</a>
        <a href="#"><i class="ri-team-line"></i> Roles</a>
        <a href="#"><i class="ri-settings-4-line"></i> Settings</a>
      </nav>

      <div style="margin-top:auto;display:flex;flex-direction:column;gap:10px;">
        <div style="display:flex;gap:8px;align-items:center;">
          <div style="width:44px;height:44px;border-radius:10px;background:linear-gradient(90deg,var(--accent-2),var(--accent-1));display:flex;align-items:center;justify-content:center;font-weight:700;color:#071024">ME</div>
          <div>
            <div style="font-weight:800">Mr Eswar</div>
            <div class="muted" style="font-size:13px">Admin</div>
          </div>
        </div>
        <div style="display:flex;gap:8px;">
          <button class="ghost" id="themeToggle"><i class="ri-sun-line"></i></button>
          <button class="ghost"><i class="ri-logout-box-r-line"></i></button>
        </div>
      </div>
    </aside>

    <main class="panel">
      <div class="panel-header">
        <div style="display:flex;flex-direction:column;gap:6px">
          <div style="display:flex;gap:12px;align-items:center">
            <div style="font-size:22px;font-weight:800">Users</div>
            <div class="muted">Manage team, roles & access</div>
          </div>

          <div class="stats">
            <div class="stat">
              <h3>Total Users</h3>
              <p id="statTotal">1,248</p>
            </div>
            <div class="stat">
              <h3>Active</h3>
              <p id="statActive">1,114</p>
            </div>
            <div class="stat">
              <h3>Pending Invites</h3>
              <p id="statPending">18</p>
            </div>
          </div>
        </div>

        <div class="controls">
          <div class="search" role="search">
            <i class="ri-search-line"></i>
            <input id="q" placeholder="Search by name, email or role..." />
          </div>
          <button class="ghost" id="exportBtn"><i class="ri-file-download-line"></i> Export</button>
          <button class="btn" id="addUserBtn"><i class="ri-user-add-line"></i> Add User</button>
        </div>
      </div>

      <div class="table-wrap">
        <table aria-label="user table">
          <thead>
            <tr>
              <th>User</th>
              <th>Email</th>
              <th>Role</th>
              <th>Last Seen</th>
              <th>Status</th>
              <th style="text-align:right">Actions</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <!-- Rows injected by JS -->
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Modal -->
  <div class="modal" id="modal" aria-hidden="true">
    <div class="window" role="dialog" aria-modal="true">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
        <div style="font-weight:800">Add / Edit User</div>
        <button class="ghost" id="closeModal"><i class="ri-close-line"></i></button>
      </div>
      <form id="userForm">
        <div class="row" style="margin-bottom:10px">
          <div style="flex:1">
            <label for="name">Full name</label>
            <input id="name" required />
          </div>
          <div style="width:180px">
            <label for="role">Role</label>
            <select id="role"><option>Member</option><option>Manager</option><option>Admin</option></select>
          </div>
        </div>
        <label for="email">Email</label>
        <input id="email" type="email" required />
        <div style="display:flex;justify-content:flex-end;margin-top:12px;gap:8px">
          <button type="button" class="ghost" id="cancel">Cancel</button>
          <button class="btn" type="submit">Save user</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    /* ---------- Sample data ---------- */
    const users = [];
    const roles = ['Admin','Manager','Member'];
    const firstNames = ['Ava','Liam','Noah','Olivia','Emma','Lucas','Mia','Ethan','Zara','Arjun','Karan','Saanvi'];
    const domains = ['example.com','zenter.app','company.co'];
    function randInt(n){return Math.floor(Math.random()*n)}
    for(let i=0;i<14;i++){
      const fn = firstNames[randInt(firstNames.length)];
      const ln = ['Smith','Patel','Singh','Johnson','Brown','Shah'][randInt(6)];
      const name = fn+' '+ln;
      users.push({id:i+1,name, email: fn.toLowerCase()+'.'+ln.toLowerCase()+'@'+domains[randInt(domains.length)], role: roles[randInt(roles.length)], lastSeen: `${randInt(28)+1} Aug 2025`, active: Math.random()>0.15})
    }

    /* ---------- Render rows ---------- */
    const tbody = document.getElementById('tbody');
    function avatarFor(name,idx){
      const hue = 200 + (idx*17)%120;
      const initials = name.split(' ').map(s=>s[0]).slice(0,2).join('');
      return `<div class="avatar" style="background:linear-gradient(90deg,hsl(${hue} 70% 60%), hsl(${(hue+60)%360} 70% 60%));">${initials}</div>`
    }

    function rolePill(role){
      const color = role==='Admin'? 'linear-gradient(90deg,#ff8a65, #ff4757)': role==='Manager' ? 'linear-gradient(90deg,#ffd166, #ffb86b)' : 'linear-gradient(90deg,#7c5cff,#00d4ff)';
      return `<span class="role" style="background:${color};color:#071024">${role}</span>`
    }

    function render(list){
      tbody.innerHTML = '';
      list.forEach((u,idx)=>{
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${avatarFor(u.name,idx)} <strong style="margin-left:10px">${u.name}</strong></td>
          <td>${u.email}</td>
          <td>${rolePill(u.role)}</td>
          <td>${u.lastSeen}</td>
          <td>${u.active? '<div class="switch on"><span></span></div>' : '<div class="switch"><span></span></div>'}</td>
          <td style="text-align:right">
            <button class="ghost" data-id="${u.id}" data-action="edit"><i class="ri-pencil-line"></i></button>
            <button class="ghost" data-id="${u.id}" data-action="delete"><i class="ri-delete-bin-6-line"></i></button>
          </td>
        `;
        tbody.appendChild(tr);
      })
    }

    render(users);

    /* ---------- Search/filter ---------- */
    document.getElementById('q').addEventListener('input', e=>{
      const q = e.target.value.trim().toLowerCase();
      if(!q) return render(users);
      const filtered = users.filter(u=> (u.name+u.email+u.role).toLowerCase().includes(q));
      render(filtered);
    })

    /* ---------- Modal (add/edit) ---------- */
    const modal = document.getElementById('modal');
    const addUserBtn = document.getElementById('addUserBtn');
    const closeModal = document.getElementById('closeModal');
    const cancel = document.getElementById('cancel');
    const userForm = document.getElementById('userForm');
    let editingId = null;

    function openModal(edit=null){
      editingId = edit;
      modal.classList.add('show');
      modal.style.pointerEvents='auto';
      modal.setAttribute('aria-hidden','false');
      const win = modal.querySelector('.window');
      if(edit){
        const user = users.find(x=>x.id===edit);
        userForm.name.value = user.name; userForm.email.value = user.email; userForm.role.value = user.role;
      } else { userForm.reset(); }
    }
    function close(){ modal.classList.remove('show'); modal.style.pointerEvents='none'; modal.setAttribute('aria-hidden','true'); editingId=null }
    addUserBtn.addEventListener('click', ()=>openModal(null));
    closeModal.addEventListener('click', close); cancel.addEventListener('click', close);

    userForm.addEventListener('submit', e=>{
      e.preventDefault();
      const data = { id: editingId || (users.length+1), name: userForm.name.value, email: userForm.email.value, role: userForm.role.value, lastSeen: 'Just now', active: true };
      if(editingId){
        const i = users.findIndex(x=>x.id===editingId); users[i] = {...users[i], ...data};
      } else users.unshift(data);
      render(users);
      close();
    })

    /* ---------- Table actions ---------- */
    tbody.addEventListener('click', e=>{
      const btn = e.target.closest('button'); if(!btn) return;
      const id = Number(btn.dataset.id); const action = btn.dataset.action;
      if(action==='edit') openModal(id);
      if(action==='delete'){
        const idx = users.findIndex(u=>u.id===id); if(idx>-1){ users.splice(idx,1); render(users); }
      }
    })

    /* ---------- Export CSV ---------- */
    document.getElementById('exportBtn').addEventListener('click', ()=>{
      const rows = [['Name','Email','Role','LastSeen','Active'], ...users.map(u=>[u.name,u.email,u.role,u.lastSeen,u.active])];
      const csv = rows.map(r=>r.map(c=>`"${c}"`).join(',')).join('\n');
      const blob = new Blob([csv],{type:'text/csv'});
      const url = URL.createObjectURL(blob); const a = document.createElement('a'); a.href=url; a.download='users.csv'; a.click(); URL.revokeObjectURL(url);
    })

    /* ---------- Small interactive 3D tilt for preview on mouse move ---------- */
    document.querySelectorAll('.preview').forEach(el=>{
      el.addEventListener('mousemove', e=>{
        const r = el.getBoundingClientRect();
        const cx = r.left + r.width/2; const cy = r.top + r.height/2;
        const dx = (e.clientX - cx)/r.width; const dy = (e.clientY - cy)/r.height;
        el.style.transform = `rotateX(${(-dy*12).toFixed(2)}deg) rotateY(${(dx*12).toFixed(2)}deg) translateZ(18px)`;
      })
      el.addEventListener('mouseleave', ()=> el.style.transform='translateZ(0)')
    })

    /* ---------- Animated particle background (canvas) ---------- */
    const canvas = document.getElementById('bgCanvas');
    const ctx = canvas.getContext('2d');
    let W, H, particles;
    function init(){ W=canvas.width = innerWidth; H=canvas.height = innerHeight; particles = []; for(let i=0;i<90;i++){particles.push({x:Math.random()*W,y:Math.random()*H,r: Math.random()*2+0.5, vx:(Math.random()-0.5)*0.3, vy:(Math.random()-0.5)*0.3, hue: 180+Math.random()*160})} }
    function tick(){ ctx.clearRect(0,0,W,H); for(let p of particles){ p.x+=p.vx; p.y+=p.vy; if(p.x<0) p.x=W; if(p.x>W) p.x=0; if(p.y<0) p.y=H; if(p.y>H) p.y=0; ctx.beginPath(); ctx.fillStyle = `hsla(${p.hue},80%,60%,0.08)`; ctx.arc(p.x,p.y,p.r,0,Math.PI*2); ctx.fill(); }
      requestAnimationFrame(tick);
    }
    init(); tick(); addEventListener('resize', init);

    /* subtle parallax via mouse */
    document.addEventListener('mousemove', e=>{
      const rx = (e.clientX/window.innerWidth - 0.5)*20; const ry = (e.clientY/window.innerHeight - 0.5)*20;
      document.querySelectorAll('.sidebar,.panel').forEach((el,i)=> el.style.transform = `translateZ(${40 - i*20}px) rotateY(${i?0:-6}deg) translateX(${ -rx }px) translateY(${ -ry }px)`)
    })

    /* small accessibility: escape to close modal */
    document.addEventListener('keydown', e=>{ if(e.key==='Escape') close(); })

    /* quick theme toggle (demo) */
    document.getElementById('themeToggle').addEventListener('click', ()=>{
      document.body.classList.toggle('light');
      if(document.body.classList.contains('light')){
        document.documentElement.style.setProperty('--bg-1','#f6f8fb'); document.documentElement.style.setProperty('--muted','rgba(10,12,20,0.6)'); document.documentElement.style.setProperty('--glass-border','rgba(10,12,20,0.06)'); document.body.style.color='#071024'
      } else {
        document.documentElement.style.setProperty('--bg-1','#0f1724'); document.documentElement.style.setProperty('--muted','rgba(255,255,255,0.65)'); document.documentElement.style.setProperty('--glass-border','rgba(255,255,255,0.08)'); document.body.style.color='#eaf0ff'
      }
    })

    /* touch improvements for mobile */
    let touchY=0; document.addEventListener('touchstart', e=> touchY = e.touches[0].clientY);
  </script>
</body>
</html>
