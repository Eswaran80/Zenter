<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <style>
    /* Reset */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Segoe UI", Roboto, sans-serif; }
    body { background: #f6f8fa; color: #222; }

    .main-content { margin-left:200px; padding:80px 20px 20px 20px; }
    @media(max-width:768px) {
      .main-content { margin-left:0; padding:100px 10px 20px 10px; }
    }

    /* Panel */
    .panel { background: #fff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); padding: 20px; }
    .panel-header { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 16px; margin-bottom: 20px; }
    .panel-header .muted { color: #666; font-size: 14px; }

    /* Stats */
    .stats { display: flex; gap: 20px; margin-top: 12px; }
    .stat { background: #f2f4f7; padding: 12px 16px; border-radius: 8px; text-align: center; }
    .stat h3 { font-size: 14px; color: #555; margin-bottom: 6px; }
    .stat p { font-size: 18px; font-weight: 700; color: #111; }

    /* Controls */
    .controls { display: flex; align-items: center; gap: 10px; }
    .search input { padding: 8px 12px; border-radius: 6px; border: 1px solid #ccc; width: 220px; }
    .search input:focus { border-color: #007bff; outline: none; }

    /* Buttons */
    .btn { background: #007bff; color: #fff; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; }
    .btn:hover { background: #0062d6; }
    .ghost { background: transparent; border: 1px solid #ccc; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-size: 14px; }
    .ghost:hover { border-color: #007bff; color: #007bff; }

    /* Table */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #f2f4f7; }
    th, td { padding: 12px 10px; text-align: left; font-size: 14px; border-bottom: 1px solid #eee; }
    th { font-weight: 600; color: #444; }
    td button { margin-left: 6px; padding: 5px 10px; border-radius: 4px; border: none; cursor: pointer; font-size: 13px; }
    td button:first-child { background: #ff4d4f; color: #fff; }
    td button:first-child:hover { background: #e04445; }
    td button:last-child { background: #ffa940; color: #fff; }
    td button:last-child:hover { background: #e38c27; }

    /* Modal */
    .modal {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
      display: flex; align-items: center; justify-content: center;
      opacity: 0; pointer-events: none;
      transition: opacity 0.3s ease;
    }
    .modal.show { opacity: 1; pointer-events: auto; }
    .window {
      background: #fff; padding: 20px; border-radius: 12px;
      width: 400px; max-width: 95%;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .window label { display: block; margin-bottom: 4px; color: #444; font-size: 13px; }
    .window input, .window select {
      width: 100%; padding: 8px; margin-bottom: 12px;
      border: 1px solid #ccc; border-radius: 6px; font-size: 14px;
    }
    .window input:focus, .window select:focus { border-color: #007bff; outline: none; }
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
            <div class="stat"><h3>Total Users</h3><p id="statTotal">{{$total ?? 0}}</p></div>
            <div class="stat"><h3>Active</h3><p id="statActive">{{$active ?? 0}}</p></div>
            <div class="stat"><h3>Inactive</h3><p id="statPending">{{$inactive ?? 0}}</p></div>
          </div>
        </div>
        <div class="controls">
          <div class="search"><input id="q" placeholder="Search by name, email or role..." /></div>
          <button class="ghost">Export</button>
          <button class="btn" id="addUserBtn">Add User</button>
        </div>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>User</th><th>Email</th><th>Role</th><th>Since</th><th>Status</th><th style="text-align:right">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $users)
            <tr>
              <td>{{$users->username}}</td>
              <td>{{$users->email}}</td>
              <td>{{$users->role}}</td>
              <td>{{$users->created_at}}</td>
              <td>
                @if($users->status == 1)
                  <span class="status active">Active</span>
                @else
                  <span class="status inactive">Inactive</span>
                @endif
              </td>
              <td style="text-align:right">
                <button>Delete</button>
                <button onclick="openEditModal()">Edit</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>

  @if(session('error'))
         <script>alert('Username Already Exists')</script>
        @endif


  <!-- Add User Modal -->
  <div class="modal" id="addUserModal">
    <div class="window">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
        <div style="font-weight:800">Add User</div>
        <button class="ghost" onclick="closeModal('addUserModal')">X</button>
      </div>
      <form action="{{route('user.store')}}" method="post">
        @csrf
        <label>Username</label>
        <input name="username" required />
        
        <label>Email</label>
        <input name="email" type="email" required />

        <label>Password</label>
         <input name="password" type="password" required />

        <label>Role</label>
        <select name="role"><option>Member</option><option>Manager</option><option>Admin</option></select>
        

        <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:12px">
          <button type="button" class="ghost" onclick="closeModal('addUserModal')">Cancel</button>
          <button class="btn" type="submit">Save User</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Edit User Modal -->
  <div class="modal" id="editUserModal">
    <div class="window">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
        <div style="font-weight:800">Edit User</div>
        <button class="ghost" onclick="closeModal('editUserModal')">X</button>
      </div>
      <form >
        <label>Full name</label>
        <input id="editName" required />

        <label>Email</label>
        <input id="editEmail" type="email" required />

        <label>Role</label>
        <select id="editRole"><option>Member</option><option>Manager</option><option>Admin</option></select>

        <label>Status</label>
        <select id="editStatus"><option value="1">Active</option><option value="0">Inactive</option></select>

        <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:12px">
          <button type="button" class="ghost" onclick="closeModal('editUserModal')">Cancel</button>
          <button class="btn" type="submit">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModal(id){ document.getElementById(id).classList.add('show'); }
    function closeModal(id){ document.getElementById(id).classList.remove('show'); }

    document.getElementById('addUserBtn').addEventListener('click', () => openModal('addUserModal'));
    function openEditModal(){ openModal('editUserModal'); }
  </script>
</body>
</html>
