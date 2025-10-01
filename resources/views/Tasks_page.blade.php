<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Manager Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
  /* Base */
body {
  margin: 0;
  font-family: "Poppins", sans-serif;
  background: linear-gradient(135deg, #0f172a, #1e293b);
  color: #fff;
}

.main-content {
  margin-left: 200px;
  padding: 20px;
}
@media(max-width:768px) {
  .main-content { margin-left: 0; padding: 100px 10px 20px 10px; }
}

/* Glassmorphism Box */
.glass {
  background: rgba(255,255,255,0.05);
  border-radius: 16px;
  padding: 20px;
  margin: 20px 0;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

/* Header */
.header h1 {
  font-size: 28px;
  margin-bottom: 5px;
}
.header p {
  opacity: 0.7;
  margin: 0;
}

/* Cards */
.card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 20px;
  margin: 20px 0;
}
.card {
  padding: 20px;
  border-radius: 12px;
  font-weight: 600;
  text-align: center;
  color: #fff;
}
.card.total { background: linear-gradient(135deg,#3b82f6,#1e40af); }
.card.pending { background: linear-gradient(135deg,#f97316,#b45309); }
.card.progress { background: linear-gradient(135deg,#a855f7,#6b21a8); }
.card.completed { background: linear-gradient(135deg,#22c55e,#166534); }

/* Buttons */
button, .btn {
  padding: 8px 16px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: 0.2s;
  margin: 2px;
}
button:hover, .btn:hover { opacity: 0.8; }
.btn.edit { background: #3b82f6; color: #fff; }
.btn.delete, .bulk-delete { background: #ef4444; color: #fff; }
.task-form button {
  background: #3b82f6;
  color: #fff;
}

/* Table */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}
th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid rgba(255,255,255,0.1);
}
th { background: rgba(255,255,255,0.1); }
td select, td input[type="date"] {
  padding: 5px;
  border-radius: 6px;
  border: none;
  outline: none;
}

/* Badges */
.badge {
  padding: 4px 10px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: bold;
}
.badge.progress { background: #a855f7; }
.badge.pending { background: #f97316; }
.badge.high { background: #ef4444; }
.badge.medium { background: #facc15; color: #000; }
.badge.low { background: #22c55e; }

/* Timeline */
.timeline-item { margin: 15px 0; }
.progress-bar {
  background: rgba(255,255,255,0.1);
  border-radius: 8px;
  height: 8px;
  overflow: hidden;
}
.progress-bar span {
  display: block;
  height: 100%;
  background: #3b82f6;
  border-radius: 8px;
}

/* Reports */
.reports {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
  gap: 20px;
}
.report-item h4 { margin-bottom: 10px; }

/* Activity */
.activity { margin-top: 10px; }
.activity-item {
  display: flex;
  align-items: center;
  margin: 10px 0;
}
.avatar {
  width: 40px; height: 40px;
  border-radius: 50%;
  background: #3b82f6;
  margin-right: 10px;
}
.timestamp { font-size: 12px; opacity: 0.6; }

/* Task Management Filters */
.tm-filters {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 15px;
}
.tm-filters input, .tm-filters select {
  padding: 8px;
  border-radius: 6px;
  border: none;
  outline: none;
}
.tm-filters button {
  background: #3b82f6;
  color: #fff;
}

  
  </style>
</head>
<body>
    <x-sidebar/>

  <div class="main-content">
    <!-- keep your content here (same as you provided) -->
  </div>
</body>
</html>
✨ Features added
  </style>
</head>
<body>
    <x-sidebar/>

  <div class="main-content">

    <!-- Header -->
    <div class="header glass">
      <h1>Task Manager Dashboard</h1>
      <p>Overview of your tasks and projects</p>
    </div>

    <!-- Overview Cards -->
    <div class="card-grid">
      <div class="card total">Total Tasks: 12</div>
      <div class="card pending">Pending: 4</div>
      <div class="card progress">In Progress: 5</div>
      <div class="card completed">Completed: 3</div>
    </div>

    <!-- Add Task Form -->
    <div class="glass task-form">
      <button>Add Task</button>
    </div>

    <form action="">
      
    </form>

    <!-- Task Table -->
    <div class="glass table-container">
      <h2>Detailed Task Table</h2>
      <table>
        <thead>
          <tr>
            <th>#</th><th>Task</th><th>Status</th><th>Priority</th><th>Due Date</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td><td>Design Homepage</td>
            <td><span class="badge progress">In Progress</span></td>
            <td><span class="badge high">High</span></td>
            <td>2025-09-25</td>
            <td><button class="btn edit">Edit</button><button class="btn delete">Delete</button></td>
          </tr>
          <tr>
            <td>2</td><td>API Integration</td>
            <td><span class="badge pending">Pending</span></td>
            <td><span class="badge medium">Medium</span></td>
            <td>2025-09-27</td>
            <td><button class="btn edit">Edit</button><button class="btn delete">Delete</button></td>
          </tr>
        </tbody>
      </table>
    </div>


    <!-- Timeline -->
    <div class="glass">
      <h2>Project Timeline</h2>
      <div class="timeline-item">
        <p>UI Design - Due 25 Sep</p>
        <div class="progress-bar"><span style="width:70%"></span></div>
      </div>
      <div class="timeline-item">
        <p>Backend API - Due 28 Sep</p>
        <div class="progress-bar"><span style="width:40%"></span></div>
      </div>
    </div>

    <!-- Reports -->
    <div class="glass">
      <h2>Reports & Progress</h2>
      <div class="reports">
        <div class="report-item">
          <h4>Tasks Completed</h4>
          <div class="progress-bar"><span style="width:60%"></span></div>
        </div>
        <div class="report-item">
          <h4>In Progress</h4>
          <div class="progress-bar"><span style="width:40%"></span></div>
        </div>
      </div>
    </div>

    <!-- Activity -->
    <div class="glass">
      <h2>Recent Activity</h2>
      <div class="activity">
        <div class="activity-item">
          <div class="avatar"></div>
          <div><strong>John</strong> updated task <em>API Integration</em><br><span class="timestamp">2h ago</span></div>
        </div>
        <div class="activity-item">
          <div class="avatar"></div>
          <div><strong>Sara</strong> completed task <em>UI Design</em><br><span class="timestamp">5h ago</span></div>
        </div>
      </div>
    </div>

    <!-- Task Management Page -->
    <div class="glass" style="margin-top:30px;">
      <h2>Task Management</h2>
      <div class="tm-filters">
        <input type="text" placeholder="Search tasks...">
        <select>
          <option value="">All Statuses</option>
          <option>Pending</option>
          <option>In Progress</option>
          <option>Completed</option>
        </select>
        <select>
          <option value="">All Priorities</option>
          <option>High</option>
          <option>Medium</option>
          <option>Low</option>
        </select>
        <button>Bulk Complete</button>
        <button class="bulk-delete">Bulk Delete</button>
      </div>
      <div class="table-container tm-table">
        <table>
          <thead>
            <tr>
              <th><input type="checkbox"></th>
              <th>#</th>
              <th>Task Name</th>
              <th>Status</th>
              <th>Priority</th>
              <th>Assigned To</th>
              <th>Due Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td>1</td>
              <td contenteditable="true">Design Homepage</td>
              <td>
                <select>
                  <option>Pending</option>
                  <option selected>In Progress</option>
                  <option>Completed</option>
                </select>
              </td>
              <td>
                <select>
                  <option>High</option>
                  <option selected>Medium</option>
                  <option>Low</option>
                </select>
              </td>
              <td contenteditable="true">Sara</td>
              <td><input type="date" value="2025-09-25"></td>
              <td><button>Save</button><button class="delete">Delete</button></td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>2</td>
              <td contenteditable="true">API Integration</td>
              <td>
                <select>
                  <option selected>Pending</option>
                  <option>In Progress</option>
                  <option>Completed</option>
                </select>
              </td>
              <td>
                <select>
                  <option>High</option>
                  <option>Medium</option>
                  <option selected>Low</option>
                </select>
              </td>
              <td contenteditable="true">John</td>
              <td><input type="date" value="2025-09-27"></td>
              <td><button>Save</button><button class="delete">Delete</button></td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>
    </div>

  </div>
</body>
</html>
