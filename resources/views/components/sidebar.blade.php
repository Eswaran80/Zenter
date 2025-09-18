<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zenter Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', sans-serif; }
body { background:backgroud colour; color:#333; }

/* Sidebar */
.sidebar { position: fixed; left:0; top:0; width:200px; height:100%; background: linear-gradient(180deg,#6C63FF,#00C9A7); color:#fff; display:flex; flex-direction:column; padding:15px 0; z-index:1000; }
.sidebar h2 { text-align:center; margin-bottom:20px; font-size:1.5rem; font-weight:bold; display:flex; align-items:center; justify-content:center; gap:8px; }
.sidebar h2 img { width:28px; height:28px; }
.sidebar a { display:flex; align-items:center; padding:10px 15px; color:#fff; text-decoration:none; margin-bottom:5px; font-size:0.95rem; transition:0.3s; position:relative; }
.sidebar a:hover { background:rgba(46, 48, 158, 1); transform:translateX(5px); }
.sidebar i { margin-right:10px; font-size:1.2rem; }

/* Top Header */
.top-header { position: fixed; top:0; left:200px; right:0; height:60px; background: linear-gradient(90deg,#6C63FF,#00C9A7); display:flex; justify-content:flex-end; align-items:center; padding:0 20px; box-shadow:0 3px 12px rgba(0,0,0,0.15); z-index:1001; }
.top-header .top-right { display:flex; align-items:center; position:relative; gap:20px; }
.top-header .profile-icon { font-size:1.6rem; color:#fff; cursor:pointer; transition:0.3s; }
.top-header .profile-icon:hover { color:#ffe600; transform:scale(1.2); }
.top-header .notif { position:relative; font-size:1.5rem; color:#fff; cursor:pointer; transition:0.3s; }
.top-header .notif:hover { color:#ffe600; transform:rotate(15deg); }
.notif-badge { position:absolute; top:-5px; right:-5px; background:#ff3d00; color:#fff; font-size:0.65rem; padding:2px 5px; border-radius:50%; font-weight:bold; }

/* Dropdown Menu */
.dropdown { position:absolute; top:45px; right:0; background:#fff; border-radius:8px; box-shadow:0 3px 10px rgba(0,0,0,0.15); display:none; min-width:150px; z-index:1002; padding:5px 0; animation:fadeIn 0.3s ease-in-out; }
.dropdown a { display:block; padding:10px 15px; text-decoration:none; color:#333; font-size:0.9rem; transition:0.3s; }
.dropdown a:hover { background:#f4f4f4; }
@keyframes fadeIn { from{opacity:0; transform:translateY(-10px);} to{opacity:1; transform:translateY(0);} }
-item, .activity-item { margin-bottom:8px; padding:6px 10px; border-radius:8px; background:#f9f9f9; display:flex; align-items:center; justify-content:space-between; }
.task-item i, .activity-item i { margin-right:6px; color:#6C63FF; }



/* Responsive */
@media(max-width:768px) { .main-content { margin-left:0; padding:100px 10px 20px 10px; } .sidebar { width:55px; } .sidebar h2 { display:none; } .sidebar a span { display:none; } .top-header { left:55px; } }



.sidebar a,
.sidebar button.logout-link {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    color: #fff;
    text-decoration: none;
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    font-size: 16px;
    cursor: pointer;
}

.sidebar a:hover,
.sidebar button.logout-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.btn1.active{
    background-color: #0366d1;
    border-color: #ff3d00;
}
.btn1.active:hover{
    background:  #0366d1;
    cursor:default;
}


</style>
</head>
<body>

<!-- Top Header -->
<div class="top-header">
    <div class="top-right">
        <div class="notif">
            <i class="ri-notification-line"></i>
            <span class="notif-badge">3</span>
        </div>
        <i class="ri-user-3-line profile-icon" onclick="toggleDropdown()"></i>
        <div class="dropdown" id="profileDropdown">
            <a href="#"><i class="ri-user-line"></i>Profile</a>
            <a href="#"><i class="ri-settings-3-line"></i> Settings</a>
            {{-- <a onclick="window.location='{{'/'}}'" ><i class="ri-logout-circle-r-line"></i> Logout</a> --}}
    
        </div>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <h2><img src="https://i.imgur.com/6C63FFlogo.png" alt="Logo"> Zenter</h2>
    <a href="#" class="btn1 {{ Route::is('dashboard.show') ? 'active' : '' }} " onclick="window.location='{{route('dashboard.show')}}'"><i class="ri-dashboard-line"></i><span>Dashboard</span></a>
    <a href="#" class="btn1 {{ Route::is('users.page') ? 'active' : '' }} " onclick="window.location='{{route('users.page')}}'" ><i class="ri-user-settings-line"></i><span>Users</span></a>
    <a href="#" class="btn1 {{ Route::is('task-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('task-page-show')}}'"><i  class="ri-task-line" ></i><span>Tasks</span></a>
    <a href="#" class="btn1 {{ Route::is('team-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('team-page-show')}}'"><i class="ri-team-line"></i><span>Team</span></a>
    <a href="#" class="btn1 {{ Route::is('reports-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('reports-page-show')}}'"><i class="ri-bar-chart-line"></i><span>Reports</span></a>
    <a href="#" class="btn1 {{ Route::is('notifications-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('notifications-page-show')}}'"><i class="ri-notification-line"></i><span>Notifications</span></a>
    <a href="#" class="btn1 {{ Route::is('calendar-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('calendar-page-show')}}'"><i class="ri-calendar-line"></i><span>Calendar</span></a>
    <a href="#" class="btn1 {{ Route::is('projects-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('projects-page-show')}}'"><i class="ri-folder-line"></i><span>Projects</span></a>
    <a href="#" class="btn1 {{ Route::is('messages-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('messages-page-show')}}'"><i class="ri-chat-1-line"></i><span>Messages</span></a>
    <a href="#" class="btn1 {{ Route::is('account-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('account-page-show')}}'"><i class="ri-user-settings-line"></i><span>Account</span></a>
    <a href="#" class="btn1 {{ Route::is('support-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('support-page-show')}}'"><i class="ri-customer-service-2-line"></i><span>Support</span></a>
    <a href="#" class="btn1 {{ Route::is('settings-page-show') ? 'active' : '' }} "  onclick="window.location='{{route('settings-page-show')}}'"><i class="ri-settings-3-line"></i><span>Settings</span></a>
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="logout-link">
            <i class="ri-logout-circle-r-line"></i><span>Logout</span>
        </button>
    </form>
</div>



</body>
</html>



<script>
// Profile Dropdown
function toggleDropdown(){
    const dropdown = document.getElementById('profileDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

</script>
