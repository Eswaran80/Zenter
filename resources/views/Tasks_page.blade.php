<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Manager Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #0f172a, #1e293b);
      color: #fff;
    }
    .main-content {
      margin-left: 200px;
      padding: 80px 20px 20px 20px;
    }
    @media(max-width:768px) {
      .main-content { margin-left: 0; padding: 100px 10px 20px 10px; }
    }

    .glass {
      background: rgba(255,255,255,0.08);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      margin-bottom: 20px;
    }
    .header h1 { font-size: 2rem; margin: 0; }
    .header p { color: #cbd5e1; margin-top: 5px; }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 20px;
      margin: 20px 0;
    }
    .card {
      padding: 20px;
      border-radius: 16px;
      color: #fff;
      font-weight: bold;
      transition: transform .2s;
    }
    .card:hover { transform: translateY(-5px); }
    .card.total { background: linear-gradient(135deg,#6366f1,#4338ca); }
    .card.pending { background: linear-gradient(135deg,#f59e0b,#d97706); }
    .card.progress { background: linear-gradient(135deg,#3b82f6,#1d4ed8); }
    .card.completed { background: linear-gradient(135deg,#10b981,#047857); }

    .task-form input,
    .task-form select,
    .task-form button {
      padding: 10px;
      border: none;
      border-radius: 8px;
      margin-right: 10px;
      margin-bottom: 10px;
    }
    .task-form input,
    .task-form select {
      flex: 1;
    }
    .task-form button {
      background: #6366f1;
      color: #fff;
      cursor: pointer;
      transition: background .3s;
    }
    .task-form button:hover { background: #4f46e5; }
    .task-form { display: flex; flex-wrap: wrap; }

    .table-container { overflow-x: auto; }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
    }
    th { background: rgba(255,255,255,0.1); }
    tr:nth-child(even) { background: rgba(255,255,255,0.05); }
    .badge {
      padding: 5px 10px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: bold;
      text-transform: capitalize;
    }
    .badge.pending { background: #fef3c7; color:#92400e; }
    .badge.progress { background: #dbeafe; color:#1e40af; }
    .badge.completed { background: #d1fae5; color:#065f46; }
    .badge.high { background: #fee2e2; color: #b91c1c; }
    .badge.medium { background: #fde68a; color: #92400e; }
    .badge.low { background: #d1fae5; color: #065f46; }
    .btn {
      padding: 6px 12px;
      border-radius: 8px;
      cursor: pointer;
      border: none;
      margin-right: 5px;
    }
    .btn.edit { background:#3b82f6; color:#fff; }
    .btn.delete { background:#ef4444; color:#fff; }

    .kanban { display: flex; gap: 20px; overflow-x: auto; }
    .kanban-col {
      min-width: 250px;
      flex: 1;
    }
    .kanban-col h3 { margin-bottom: 10px; }
    .kanban-task {
      background: rgba(255,255,255,0.1);
      padding: 10px;
      border-radius: 12px;
      margin-bottom: 10px;
    }

    .timeline-item {
      margin-bottom: 15px;
    }
    .progress-bar {
      height: 6px;
      border-radius: 4px;
      background: #334155;
      margin-top: 5px;
    }
    .progress-bar span {
      display: block;
      height: 100%;
      border-radius: 4px;
      background: #6366f1;
    }

    .reports { display: grid; grid-template-columns: repeat(auto-fit,minmax(200px,1fr)); gap:20px; }
    .report-item h4 { margin: 0 0 5px 0; }

    .activity { max-height: 200px; overflow-y: auto; }
    .activity-item {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }
    .avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #6366f1;
    }
    .timestamp { font-size: 12px; color:#94a3b8; }

    /* Task Management Page */
    .tm-filters {
      display:flex;
      gap:15px;
      flex-wrap:wrap;
      margin-bottom:15px;
    }
    .tm-filters input,
    .tm-filters select,
    .tm-filters button {
      padding:10px;
      border-radius:8px;
      border:none;
      font-family:inherit;
    }
    .tm-filters input[type="text"] {
      flex:2;
      min-width:160px;
    }
    .tm-filters select {
      min-width:120px;
    }
    .tm-filters button {
      background:#10b981;
      color:#fff;
      font-weight:bold;
      cursor:pointer;
      transition:background .2s;
    }
    .tm-filters button.bulk-delete {
      background:#ef4444;
    }
    .tm-filters button:hover { background: #08917a;}
    .tm-filters button.bulk-delete:hover { background: #b91c1c;}
    .tm-table input[type="date"] {
      background:rgba(255,255,255,0.09);
      color:#fff;
      border-radius:6px;
      padding:6px 10px;
      border: none;
      font-family:inherit;
    }
    .tm-table select {
      background:rgba(255,255,255,0.11);
      color:#fff;
      border-radius:6px;
      border:none;
      padding:6px 10px;
      font-family:inherit;
    }
    .tm-table td[contenteditable="true"]:focus {
      outline: 2px solid #6366f1;
      background:rgba(99,102,241,0.09);
    }
    .tm-table button {
      padding:6px 10px;
      border-radius:7px;
      border:none;
      margin-right:4px;
      font-weight:bold;
      cursor:pointer;
      background:#3b82f6;
      color:#fff;
      transition:background .2s;
    }
    .tm-table button.delete { background:#ef4444; }
    .tm-table button:hover { background:#2563eb; }
    .tm-table button.delete:hover { background:#b91c1c; }
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
      <input type="text" placeholder="Task name">
      <input type="date">
      <select>
        <option>Pending</option>
        <option>In Progress</option>
        <option>Completed</option>
      </select>
      <button>Add Task</button>
    </div>

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

    <!-- Kanban -->
    <div class="glass">
      <h2>Kanban Board</h2>
      <div class="kanban">
        <div class="kanban-col">
          <h3>Pending</h3>
          <div class="kanban-task">Task A</div>
          <div class="kanban-task">Task B</div>
        </div>
        <div class="kanban-col">
          <h3>In Progress</h3>
          <div class="kanban-task">Task C</div>
        </div>
        <div class="kanban-col">
          <h3>Completed</h3>
          <div class="kanban-task">Task D</div>
        </div>
      </div>
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
