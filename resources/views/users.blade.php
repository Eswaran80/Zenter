<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
   
</head>
<style>

     .main-content { margin-left:200px; padding:80px 20px 20px 20px; }
    @media(max-width:768px) {
      .main-content { margin-left:0; padding:100px 10px 20px 10px; }
    }
    /* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Segoe UI", Roboto, sans-serif;
}

/* Layout */
body {
  background: #f6f8fa;
  color: #222;
}

.main-content {
  margin-left: 200px;
  padding: 80px 20px 20px 20px;
}
@media (max-width: 768px) {
  .main-content {
    margin-left: 0;
    padding: 100px 10px 20px 10px;
  }
}

/* Panel */
.panel {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  padding: 20px;
}

/* Header */
.panel-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 20px;
  flex-wrap: wrap;
  gap: 16px;
}

.panel-header .muted {
  color: #666;
  font-size: 14px;
}

.stats {
  display: flex;
  gap: 20px;
  margin-top: 12px;
}
.stat {
  background: #f2f4f7;
  padding: 12px 16px;
  border-radius: 8px;
  text-align: center;
}
.stat h3 {
  font-size: 14px;
  color: #555;
  font-weight: 600;
  margin-bottom: 6px;
}
.stat p {
  font-size: 18px;
  font-weight: 700;
  color: #111;
}

/* Controls */
.controls {
  display: flex;
  align-items: center;
  gap: 10px;
}
.search input {
  padding: 8px 12px;
  border-radius: 6px;
  border: 1px solid #ccc;
  width: 220px;
}
.search input:focus {
  outline: none;
  border-color: #007bff;
}

/* Buttons */
.btn {
  background: #007bff;
  color: #fff;
  border: none;
  padding: 8px 16px;
  font-size: 14px;
  font-weight: 600;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.2s;
}
.btn:hover { background: #0062d6; }

.ghost {
  background: transparent;
  border: 1px solid #ccc;
  padding: 8px 14px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  transition: 0.2s;
}
.ghost:hover {
  border-color: #007bff;
  color: #007bff;
}

/* Table */
.table-wrap {
  overflow-x: auto;
}
table {
  width: 100%;
  border-collapse: collapse;
}
thead {
  background: #f2f4f7;
}
th, td {
  padding: 12px 10px;
  text-align: left;
  font-size: 14px;
  border-bottom: 1px solid #eee;
}
th {
  font-weight: 600;
  color: #444;
}
td button {
  margin-left: 6px;
  padding: 5px 10px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  font-size: 13px;
}
td button:first-child {
  background: #ff4d4f;
  color: #fff;
}
td button:first-child:hover {
  background: #e04445;
}
td button:last-child {
  background: #ffa940;
  color: #fff;
}
td button:last-child:hover {
  background: #e38c27;
}

/* Modal */
.modal {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0; 
  pointer-events: none;
  transition: opacity 0.3s ease;
}
.modal.show {
  opacity: 1;
  pointer-events: auto;
}
.modal1 {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0; 
  pointer-events: none;
  transition: opacity 0.3s ease;
}
.modal1.show {
  opacity: 1;
  pointer-events: auto;
}

.window {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  width: 400px;
  max-width: 95%;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}
.window label {
  display: block;
  font-size: 13px;
  margin-bottom: 4px;
  color: #444;
}
.window input, .window select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 6px;
  margin-bottom: 12px;
  font-size: 14px;
}
.window input:focus, .window select:focus {
  border-color: #007bff;
  outline: none;
}


</style>
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
            <div class="stat"><h3>In Active</h3><p id="statPending">{{$inactive ?? 0}}</p></div>
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
            @foreach($data as $users)
            <tr>
              <td>{{$users->name}}</td><td>{{$users->email}}</td><td>{{$users->role}}</td><td>{{$users->created_at}}</td><td>
    @if($users->status == 1)
        <span class="status active">Active</span>
    @else
        <span class="status inactive">Inactive</span>
    @endif
</td><td style="text-align:right"><button>Delete</button><button id="editBtn">Edit</button></td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Modal -->
  <div class="modal" id="modal" aria-hidden="true">
    <div class="window">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
        <div style="font-weight:800">Add User</div>
        <button class="ghost" id="closeModal">X</button>
      </div>
      <form action="{{route('user.store')}}" method="post">
        @csrf
        <div class="row" style="margin-bottom:10px">

          <div style="flex:1">
            <label for="name">Full name</label>
            <input id="name" name="name" required />
          </div>
          
          <div style="width:180px">
            <label for="role">Role</label>
            <select id="role" name="role"><option>Member</option><option>Manager</option><option>Admin</option></select>
          </div>
        </div>
        <label for="email">Email</label>
        <input name="email" id="email" type="email" required />
        <div style="display:flex;justify-content:flex-end;margin-top:12px;gap:8px">
          <button type="button" class="ghost" id="cancel">Cancel</button>
          <button class="btn" type="submit" id="closeModal">Save user</button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- Modal -->
<div class="modal" id="modal1" aria-hidden="true">
  <div class="window">
    <div style="justify-content:space-between;align-items:center;margin-bottom:10px">
      <div style="font-weight:800">Edit User</div>
      <button type="button" class="ghost" id="closeModal">X</button>
    </div>

    <form id="userForm" action="{{route('user.store')}}" method="post">
      @csrf
      <label for="name">Full name</label>
      <input id="name" name="name" required />

      <label for="email">Email</label>
      <input name="email" id="email" type="email" required />

      <label for="role">Role</label>
      <select id="role" name="role">
        <option>Member</option>
        <option>Manager</option>
        <option>Admin</option>
      </select>

      <label for="status">Status</label>
      <select id="status" name="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
      </select>

      <label for="password">Password</label>
      <input id="password" name="password" type="password" placeholder="Leave blank to keep current" />

      <div style="display:flex;justify-content:flex-end;margin-top:12px;gap:8px">
        <button type="button" class="ghost" id="cancel">Cancel</button>
        <button class="btn" type="submit">Save User</button>
      </div>
    </form>
  </div>
</div>


  <script>
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
    document.getElementById('save').onclick=closeModal;

  </script>
</body>
</html>
