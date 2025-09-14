<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <style>
    :root{
      --bg-1: #0f1724;
      --accent-1: #7c5cff;
      --accent-2: #00d4ff;
      --muted: rgba(255,255,255,0.65);
      --glass-border: rgba(255,255,255,0.08);
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      background: var(--bg-1);
      color:#eaf0ff;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
    }

    /* Layout */
    .main-content { margin-left:200px; padding:80px 20px 20px 20px; }
    @media(max-width:768px) {
      .main-content { margin-left:0; padding:100px 10px 20px 10px; }
    }

    /* Sidebar */
    .sidebar{
      width:200px;
      position:fixed;
      top:0;left:0;bottom:0;
      background:linear-gradient(180deg,rgba(255,255,255,0.06), transparent);
      border-right:1px solid var(--glass-border);
      padding:20px;
    }

    /* Panel */
    .panel{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
      border-radius:18px;padding:24px;
      border:1px solid var(--glass-border);
      min-height:640px;
    }
    .panel-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}

    /* Controls */
    .search{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.06);padding:8px 12px;border-radius:999px;border:1px solid var(--glass-border);width:420px}
    .search input{background:transparent;border:0;outline:none;color:inherit;font-weight:600}
    .controls{display:flex;align-items:center;gap:12px}
    .btn{padding:10px 14px;border-radius:10px;border:0;background:linear-gradient(90deg,var(--accent-1),var(--accent-2));color:#071024;font-weight:700;cursor:pointer;}
    .ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:8px 10px;border-radius:10px;color:inherit;cursor:pointer;}

    /* Stats */
    .stats{display:flex;gap:12px;margin-top:10px}
    .stat{flex:1;padding:16px;border-radius:12px;background:rgba(17, 152, 249, 0.911);border:1px solid var(--glass-border);}
    .stat h3{margin:0;font-size:13px;color:var(--muted)}
    .stat p{margin:8px 0 0;font-size:20px;font-weight:800}

    /* Table */
    .table-wrap{margin-top:18px;background:rgba(249, 69, 69, 0.01);border-radius:12px;padding:12px;border:1px solid rgba(255,255,255,0.03)}
    table{width:100%;border-collapse:collapse;font-size:14px}
    thead th{ text-align:left;padding:12px 10px;color:var(--muted);font-weight:700; font-size:12px ;background-color: #15caee; color:white;}
    td{padding:12px 10px;vertical-align:middle;border-top:1px solid rgba(255,255,255,0.02)}
    tbody tr:hover{background:rgba(255,255,255,0.03)}

    .avatar{width:44px;height:44px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;font-weight:700;color:#071024}
    .role{font-weight:700;padding:6px 8px;border-radius:999px;font-size:12px}

    /* Switch */
    .switch{width:46px;height:26px;background:rgba(255,255,255,0.06);border-radius:999px;display:inline-block;position:relative;padding:3px}
    .switch span{position:absolute;left:3px;top:3px;width:20px;height:20px;border-radius:50%;background:white;transition:all .25s}
    .switch.on{background:linear-gradient(90deg,var(--accent-1),var(--accent-2))}
    .switch.on span{transform:translateX(20px)}

    /* Modal */
    .modal{position:fixed;inset:0;display:flex;align-items:flex-end;justify-content:center;padding:40px;z-index:9;pointer-events:none}
    .modal .window{width:640px;background:linear-gradient(90deg,var(--accent-1),var(--accent-2));color:#071024;border-radius:14px;padding:18px;border:1px solid var(--glass-border);pointer-events:auto;transform:translateY(40px);opacity:0;transition:all .28s}
    .modal.show .window{transform:translateY(0);opacity:1}

    /* Form */
    label{display:block;font-weight:600;margin-bottom:6px}
    .row{display:flex;gap:10px}
    input,select{padding:12px;border-radius:8px;background:white;border:1px solid rgba(255,255,255,0.04);outline:none;color:inherit;width:100%}
  </style>
</head>
<body>

  <x-sidebar/>

  <div class="main-content">
    <main class="panel">
      <div class="panel-header">
        <div>
          <div style="font-size:22px;font-weight:800">Users</div>
          <div class="muted">Manage team, roles & access</div>
          <div class="stats">
            <div class="stat"><h3>Total Users</h3><p id="statTotal">1,248</p></div>
            <div class="stat"><h3>Active</h3><p id="statActive">1,114</p></div>
            <div class="stat"><h3>Pending Invites</h3><p id="statPending">18</p></div>
          </div>
        </div>
        <div class="controls">
          <div class="search"><input id="q" placeholder="Search by name, email or role..." /></div>
          <button class="ghost" id="exportBtn">Export</button>
          <button class="btn" id="addUserBtn">Add User</button>
        </div>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>User</th><th>Email</th><th>Role</th><th>Last Seen</th><th>Status</th><th style="text-align:right">Actions</th>
            </tr>
          </thead>
          <tbody id="tbody">

          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Modal -->
  <div class="modal" id="modal" aria-hidden="true">
    <div class="window">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
        <div style="font-weight:800">Add / Edit User</div>
        <button class="ghost" id="closeModal">X</button>
      </div>
      <form >
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
  
      /* Search */
 
    /* Modal */
    const modal=document.getElementById('modal');
    const userForm=document.getElementById('userForm');
    let editingId=null;
    function openModal(id=null){
      editingId=id;
      modal.classList.add('show');
      modal.style.pointerEvents='auto';
      if(id){
        const u=users.find(x=>x.id===id);
        userForm.name.value=u.name; userForm.email.value=u.email; userForm.role.value=u.role;
      }else userForm.reset();
    }
    function closeModal(){modal.classList.remove('show');modal.style.pointerEvents='none';editingId=null}
    document.getElementById('addUserBtn').onclick=()=>openModal();
    document.getElementById('closeModal').onclick=closeModal;
    document.getElementById('cancel').onclick=closeModal;

    userForm.onsubmit=e=>{
      e.preventDefault();
      const data={id:editingId||users.length+1,name:userForm.name.value,email:userForm.email.value,role:userForm.role.value,lastSeen:'Just now',active:true};
      if(editingId){
        const i=users.findIndex(x=>x.id===editingId); users[i]={...users[i],...data};
      }else users.unshift(data);
      render(users); closeModal();
    };

    /* Export CSV */
    document.getElementById('exportBtn').onclick=()=>{
      const rows=[['Name','Email','Role','LastSeen','Active'],...users.map(u=>[u.name,u.email,u.role,u.lastSeen,u.active])];
      const csv=rows.map(r=>r.join(',')).join('\n');
      const blob=new Blob([csv],{type:'text/csv'});
      const a=document.createElement('a'); a.href=URL.createObjectURL(blob); a.download='users.csv'; a.click();
    };
  </script>
</body>
</html>
