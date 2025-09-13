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
body { background:#f4f7fd; color:#333; }

/* Sidebar */
.sidebar { position: fixed; left:0; top:0; width:200px; height:100%; background: linear-gradient(180deg,#6C63FF,#00C9A7); color:#fff; display:flex; flex-direction:column; padding:15px 0; z-index:1000; }
.sidebar h2 { text-align:center; margin-bottom:20px; font-size:1.5rem; font-weight:bold; display:flex; align-items:center; justify-content:center; gap:8px; }
.sidebar h2 img { width:28px; height:28px; }
.sidebar a { display:flex; align-items:center; padding:10px 15px; color:#fff; text-decoration:none; margin-bottom:5px; font-size:0.95rem; transition:0.3s; position:relative; }
.sidebar a:hover { background:rgba(255,255,255,0.2); transform:translateX(5px); }
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

/* Main Content */
.main-content { margin-left:200px; padding:80px 20px 20px 20px; }
h1 { font-size:1.8rem; margin-bottom:20px; color:#6C63FF; display:flex; align-items:center; gap:10px; }
h1 i { color:#00C9A7; }

/* Charts */
.chart-container { display:flex; flex-wrap:wrap; gap:20px; margin-bottom:20px; justify-content:space-between; }
.chart-box { flex:1 1 48%; min-width:250px; height:250px; background:#fff; padding:15px; border-radius:12px; box-shadow:0 3px 10px rgba(0,0,0,0.08); transition:transform 0.3s, box-shadow 0.3s; }
.chart-box:hover { transform:translateY(-5px); box-shadow:0 12px 28px rgba(0,0,0,0.2); }

/* Sections */
.section { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px; }
.section-box { flex:1; min-width:250px; background:#fff; padding:15px; border-radius:12px; box-shadow:0 3px 10px rgba(0,0,0,0.08); font-size:0.9rem; transition:0.3s; }
.section-box:hover { transform:translateY(-5px); box-shadow:0 12px 25px rgba(0,0,0,0.2); }
.section-box h3 { margin-bottom:10px; color:#6C63FF; font-size:1.1rem; display:flex; align-items:center; gap:6px; }
.section-box h3 i { color:#00C9A7; }
.task-item, .activity-item { margin-bottom:8px; padding:6px 10px; border-radius:8px; background:#f9f9f9; display:flex; align-items:center; justify-content:space-between; }
.task-item i, .activity-item i { margin-right:6px; color:#6C63FF; }

/* Status */
.task-item span.status { padding:2px 6px; border-radius:8px; font-size:0.75rem; font-weight:bold; }
.status.completed { background:#00C9A7; color:#fff; }
.status.pending { background:#ff9800; color:#fff; }
.status.inprogress { background:#f44336; color:#fff; }

/* Profile */
.profile-img { border-radius:50%; width:100px; height:100px; margin-bottom:10px; border:3px solid #6C63FF; animation:float 3s ease-in-out infinite; }
@keyframes float { 0%{transform:translateY(0);} 50%{transform:translateY(-6px);} 100%{transform:translateY(0);} }
.profile-btn { padding:6px 12px; border:none; border-radius:8px; background:#6C63FF; color:#fff; cursor:pointer; margin-top:8px; transition:0.3s; }
.profile-btn:hover { background:#00C9A7; transform:scale(1.05); }

/* Table */
table { width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden; box-shadow:0 3px 10px rgba(0,0,0,0.08); font-size:0.9rem; }
table th, table td { padding:10px; text-align:left; border-bottom:1px solid #eee; }
table th { background:linear-gradient(90deg,#6C63FF,#00C9A7); color:#fff; }
table tr:hover { background:#f1f1f1; }

/* Quick Stats */
.cards { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:25px; justify-content:space-between; }
.card { flex:1 1 180px; min-width:180px; background:linear-gradient(135deg,#6C63FF,#00C9A7); padding:20px; border-radius:15px; color:#fff; box-shadow:0 8px 20px rgba(0,0,0,0.15); transition:transform 0.4s, box-shadow 0.4s, font-size 0.3s; font-size:0.95rem; position:relative; overflow:hidden; }
.card:hover { transform:translateY(-5px) scale(1.05); box-shadow:0 12px 28px rgba(0,0,0,0.25); background:linear-gradient(135deg,#4A3FFF,#009688); }
.card h3 { color:#ffe600; margin-bottom:8px; font-size:1.1rem; display:flex; align-items:center; gap:6px; }
.card h3 i { color:#fff; font-size:1.2rem; }
.card p { color:rgba(255,255,255,0.9); font-size:0.9rem; }

/* Quick Stats small */
.quick-stats { display:flex; gap:20px; margin-bottom:25px; flex-wrap:wrap; justify-content:space-between; }
.quick-stat { flex:1 1 140px; min-width:120px; background:linear-gradient(135deg,#00C9A7,#6C63FF); padding:15px; border-radius:15px; color:#fff; text-align:center; box-shadow:0 8px 20px rgba(0,0,0,0.15); transition:transform 0.4s, box-shadow 0.4s, background 0.4s; position:relative; overflow:hidden; animation:pulse 3s infinite ease-in-out; }
.quick-stat:hover { transform:translateY(-5px) scale(1.05); box-shadow:0 12px 28px rgba(0,0,0,0.25); background:linear-gradient(135deg,#009688,#4A3FFF); }
.quick-stat h4 { margin-bottom:8px; font-size:1rem; font-weight:600; display:flex; align-items:center; justify-content:center; gap:6px; }
.quick-stat h4::before { content:"★"; font-size:1.1rem; color:#ffe600; }
.quick-stat p { font-size:0.85rem; color:rgba(255,255,255,0.9); font-weight:500; }

@keyframes pulse {
  0% {transform:scale(1); box-shadow:0 8px 20px rgba(0,0,0,0.15);}
  50% {transform:scale(1.03); box-shadow:0 12px 28px rgba(0,0,0,0.25);}
  100% {transform:scale(1); box-shadow:0 8px 20px rgba(0,0,0,0.15);}
}

/* Responsive */
@media(max-width:768px) { .main-content { margin-left:0; padding:100px 10px 20px 10px; } .sidebar { width:55px; } .sidebar h2 { display:none; } .sidebar a span { display:none; } .top-header { left:55px; } }
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
            <a href="#"><i class="ri-user-line"></i> Profile</a>
            <a href="#"><i class="ri-settings-3-line"></i> Settings</a>
            <a href="#"><i class="ri-logout-circle-r-line"></i> Logout</a>
        </div>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <h2><img src="https://i.imgur.com/6C63FFlogo.png" alt="Logo"> Zenter</h2>
    <a href="#"><i class="ri-dashboard-line"></i><span>Dashboard</span></a>
    <a href="#"><i class="ri-task-line"></i><span>Tasks</span></a>
    <a href="#"><i class="ri-team-line"></i><span>Team</span></a>
    <a href="#"><i class="ri-bar-chart-line"></i><span>Reports</span></a>
    <a href="#"><i class="ri-notification-line"></i><span>Notifications</span></a>
    <a href="#"><i class="ri-calendar-line"></i><span>Calendar</span></a>
    <a href="#"><i class="ri-folder-line"></i><span>Projects</span></a>
    <a href="#"><i class="ri-chat-1-line"></i><span>Messages</span></a>
    <a href="#"><i class="ri-user-settings-line"></i><span>Account</span></a>
    <a href="#"><i class="ri-customer-service-2-line"></i><span>Support</span></a>
    <a href="#"><i class="ri-settings-3-line"></i><span>Settings</span></a>
    <a href="#"><i class="ri-logout-circle-r-line"></i><span>Logout</span></a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h1><i class="ri-dashboard-fill"></i> Welcome, Eswar! 🚀</h1>

    <!-- Quick Stats -->
    <div class="quick-stats">
        <div class="quick-stat"><h4>Overdue</h4><p>5 Tasks</p></div>
        <div class="quick-stat"><h4>In Progress</h4><p>15 Tasks</p></div>
        <div class="quick-stat"><h4>Completed Today</h4><p>12 Tasks</p></div>
        <div class="quick-stat"><h4>New Messages</h4><p>3</p></div>
        <div class="quick-stat"><h4>Projects Active</h4><p>4</p></div>
    </div>

    <div class="cards">
        <div class="card"><h3><i class="ri-checkbox-circle-line"></i> Total Tasks</h3><p>120</p></div>
        <div class="card"><h3><i class="ri-check-line"></i> Completed</h3><p>75</p></div>
        <div class="card"><h3><i class="ri-time-line"></i> Pending</h3><p>30</p></div>
        <div class="card"><h3><i class="ri-team-line"></i> Team Members</h3><p>8</p></div>
        <div class="card"><h3><i class="ri-notification-2-line"></i> Notifications</h3><p>5 New</p></div>
    </div>

    <div class="chart-container">
        <div class="chart-box"><canvas id="taskChart"></canvas></div>
        <div class="chart-box"><canvas id="progressChart"></canvas></div>
    </div>

    <div class="section">
        <div class="section-box" style="text-align:center;">
            <img src="https://i.pravatar.cc/100" alt="Profile Picture" class="profile-img">
            <h3><i class="ri-user-3-fill"></i> Eswar</h3>
            <p>Role: Admin</p>
            <p>Email: eswar@example.com</p>
            <button class="profile-btn"><i class="ri-edit-line"></i> Edit Profile</button>
        </div>
        <div class="section-box">
            <h3><i class="ri-todo-line"></i> Upcoming Tasks</h3>
            <div class="task-item"><i class="ri-layout-4-line"></i> Design Landing Page <span class="status inprogress">In Progress</span></div>
            <div class="task-item"><i class="ri-database-2-line"></i> Database Migration <span class="status pending">Pending</span></div>
            <div class="task-item"><i class="ri-link-m"></i> API Integration <span class="status completed">Completed</span></div>
        </div>
        <div class="section-box">
            <h3><i class="ri-history-line"></i> Activity Feed</h3>
            <div class="activity-item"><i class="ri-check-line"></i> Sarah completed "Wireframe Design"</div>
            <div class="activity-item"><i class="ri-user-add-line"></i> David assigned "API Setup" to Mia</div>
            <div class="activity-item"><i class="ri-message-2-line"></i> New comment on "Landing Page Review"</div>
        </div>
    </div>

    <h2><i class="ri-task-line"></i> Recent Tasks</h2>
    <table>
        <thead>
            <tr><th>Task Name</th><th>Assigned To</th><th>Deadline</th><th>Status</th></tr>
        </thead>
        <tbody>
            <tr><td>Design Homepage</td><td>Sarah</td><td>2025-09-20</td><td><span class="status completed">Completed</span></td></tr>
            <tr><td>Database Setup</td><td>David</td><td>2025-09-18</td><td><span class="status inprogress">In Progress</span></td></tr>
            <tr><td>API Integration</td><td>Mia</td><td>2025-09-25</td><td><span class="status pending">Pending</span></td></tr>
        </tbody>
    </table>

    <!-- Bottom Info Section -->
    <div class="section" style="margin-top:30px;">
        <div class="section-box">
            <h3><i class="ri-folder-2-line"></i> Recent Projects</h3>
            <div class="task-item">Website Redesign <span class="status inprogress">In Progress</span></div>
            <div class="task-item">Mobile App Development <span class="status pending">Pending</span></div>
            <div class="task-item">Marketing Campaign <span class="status completed">Completed</span></div>
        </div>
        <div class="section-box">
            <h3><i class="ri-team-line"></i> Team Members Status</h3>
            <div class="activity-item"><i class="ri-circle-fill" style="color:#00C9A7;"></i> Sarah - Online</div>
            <div class="activity-item"><i class="ri-circle-fill" style="color:gray;"></i> David - Offline</div>
            <div class="activity-item"><i class="ri-circle-fill" style="color:#ff9800;"></i> Mia - Busy</div>
            <div class="activity-item"><i class="ri-circle-fill" style="color:#00C9A7;"></i> John - Online</div>
        </div>
        <div class="section-box">
            <h3><i class="ri-chat-3-line"></i> Recent Messages</h3>
            <div class="activity-item"><strong><i class="ri-message-2-line"></i> Sarah:</strong> Finished wireframe designs</div>
            <div class="activity-item"><strong><i class="ri-message-2-line"></i> David:</strong> Updated database schema</div>
            <div class="activity-item"><strong><i class="ri-message-2-line"></i> Mia:</strong> Commented on landing page</div>
        </div>
        <div class="section-box">
            <h3><i class="ri-timeline-view"></i> Activity Logs</h3>
            <div class="activity-item"><i class="ri-time-line"></i> Project "Website Redesign" deadline extended</div>
            <div class="activity-item"><i class="ri-add-line"></i> New task assigned to Mia</div>
            <div class="activity-item"><i class="ri-check-line"></i> Completed "API Integration"</div>
            <div class="activity-item"><i class="ri-settings-2-line"></i> Notification settings updated</div>
        </div>
    </div>
</div>

<script>
// Profile Dropdown
function toggleDropdown(){
    const dropdown = document.getElementById('profileDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Charts
const taskCtx = document.getElementById('taskChart').getContext('2d');
new Chart(taskCtx, {
    type: 'doughnut',
    data: {
        labels: ['Completed', 'In Progress', 'Pending'],
        datasets: [{
            data: [75, 30, 15],
            backgroundColor: ['#00C9A7', '#f44336', '#ff9800'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%',
        plugins: {
            legend: {
                display: true,
                position: 'right',
                labels: {
                    boxWidth: 20,
                    padding: 15,
                    generateLabels: function(chart) {
                        let data = chart.data;
                        if (data.labels.length && data.datasets.length) {
                            return data.labels.map((label, i) => ({
                                text: label + ' (' + data.datasets[0].data[i] + ')',
                                fillStyle: data.datasets[0].backgroundColor[i],
                                hidden: false,
                                index: i
                            }));
                        }
                        return [];
                    }
                }
            }
        }
    }
});

const progressCtx = document.getElementById('progressChart').getContext('2d');
new Chart(progressCtx,{
    type:'bar',
    data:{
        labels:['Week1','Week2','Week3','Week4'],
        datasets:[{label:'Tasks Completed',data:[10,15,12,20],backgroundColor:'#6C63FF'}]
    }
});
</script>
</body>
</html>
