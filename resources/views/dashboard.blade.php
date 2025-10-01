<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zenter Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
   * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', sans-serif;
}

body {
  background: #f5f7fb;
  color: #333;
}

/* Main Content */
.main-content {
  margin-left: 200px;
  padding: 80px 20px 40px;
}

.main-content h1 {
  font-size: 1.8rem;
  font-weight: bold;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  color: #222;
}

h2 {
  margin: 25px 0 15px;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Quick Stats */
.quick-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit,minmax(160px,1fr));
  gap: 15px;
  margin-bottom: 30px;
}

.quick-stat {
  background: #fff;
  padding: 18px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  text-align: center;
  transition: transform 0.2s;
}
.quick-stat:hover {
  transform: translateY(-4px);
}
.quick-stat h4 {
  font-size: 0.95rem;
  font-weight: 600;
  margin-bottom: 6px;
  color: #666;
}
.quick-stat p {
  font-size: 1.1rem;
  font-weight: bold;
  color: #0366d1;
}

/* Cards Section */
.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit,minmax(180px,1fr));
  gap: 20px;
  margin-bottom: 30px;
}
.card {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: transform 0.2s;
}
.card:hover {
  transform: translateY(-4px);
}
.card h3 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #444;
}
.card p {
  font-size: 1.4rem;
  font-weight: bold;
  color: #0366d1;
}

/* Charts */
.chart-container {
  display: grid;
  grid-template-columns: repeat(auto-fit,minmax(300px,1fr));
  gap: 20px;
  margin-bottom: 30px;
}
.chart-box {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  height: 320px;
}

/* Sections */
.section {
  display: grid;
  grid-template-columns: repeat(auto-fit,minmax(250px,1fr));
  gap: 20px;
  margin-bottom: 30px;
}
.section-box {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.section-box h3 {
  font-size: 1.1rem;
  font-weight: bold;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Profile Box */
.profile-img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  margin-bottom: 12px;
  border: 3px solid #0366d1;
}
.profile-btn {
  margin-top: 12px;
  padding: 8px 16px;
  background: #0366d1;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: 0.3s;
}
.profile-btn:hover {
  background: #024a9f;
}

/* Task & Activity Items */
.task-item,
.activity-item {
  background: #f9fafc;
  padding: 10px 12px;
  border-radius: 8px;
  margin-bottom: 10px;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: inset 0 1px 4px rgba(0,0,0,0.05);
}
.task-item i,
.activity-item i {
  margin-right: 6px;
  color: #0366d1;
}

/* Status Tags */
.status {
  font-size: 0.75rem;
  font-weight: bold;
  padding: 3px 8px;
  border-radius: 12px;
  color: #fff;
}
.status.inprogress { background: #ff9800; }
.status.pending { background: #f44336; }
.status.completed { background: #00C9A7; }

/* Table */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
thead {
  background: #0366d1;
  color: #fff;
}
th, td {
  padding: 12px 16px;
  text-align: left;
  font-size: 0.95rem;
}
tbody tr:nth-child(even) { background: #f9f9f9; }

/* Responsive */
@media(max-width: 768px) {
  .main-content { margin-left: 0; padding: 80px 15px 30px; }
}


</style>
<body>
 <x-sidebar/>

<!-- Main Content -->
<div class="main-content">
    <h1><i class="ri-dashboard-fill"></i> Welcome, {{auth()->user()->username}}! 🚀</h1>

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
            <h3><i class="ri-user-3-fill"></i>{{auth()->user()->username}}</h3>
            <p>Role: Admin</p>
            <p>Email:{{auth()->user()->email}}</p>
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


<script>
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            // Force reload if coming from back/forward cache
            window.location.reload();
        }
    });
</script>

</body>
</html>
