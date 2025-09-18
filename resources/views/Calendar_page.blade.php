<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
</head>
<body>
    <x-sidebar/>
    <div class="main-content">
       <h1>calendar page</h1>
       <div class="calendar">
        <h2>Calendar</h2>
        <table id="calendar-table">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody>
                <!-- Calendar days will be inserted here by JavaScript -->
            </tbody>
        </table>

        <div class="task-input">
            <input type="date" id="task-date">
            <input type="text" id="task-name" placeholder="Task Name">
            <button onclick="addTask()">Add Task</button>
        </div>
    </div>

    </div>

    
</body>
</html>

<style>

     .main-content { margin-left:200px; padding:80px 20px 20px 20px; }
    @media(max-width:768px) {
      .main-content { margin-left:0; padding:100px 10px 20px 10px; }
    }
</style>

<script>
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            // Force reload if coming from back/forward cache
            window.location.reload();
        }
    });
</script>
 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .calendar {
            width: 90%;
            max-width: 600px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .calendar table {
            width: 100%;
            border-collapse: collapse;
        }

        .calendar th, .calendar td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            position: relative;
        }

        .calendar th {
            background-color: #0d47a1;
            color: white;
        }

        .task {
            position: absolute;
            bottom: 5px;
            left: 5px;
            right: 5px;
            background-color: #ffeb3b;
            border-radius: 4px;
            padding: 2px 4px;
            font-size: 12px;
        }

        .completed {
            background-color: #4caf50;
            color: white;
        }

        .task-input {
            margin-top: 20px;
            text-align: center;
        }

        .task-input input, .task-input button {
            padding: 10px;
            margin: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
    </style>
     <script>
        const calendarTable = document.getElementById('calendar-table').getElementsByTagName('tbody')[0];

        function generateCalendar() {
            const date = new Date();
            const currentMonth = date.getMonth();
            const currentYear = date.getFullYear();

            // First day of the month
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            // Number of days in the month
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            let day = 1;
            for (let i = 0; i < 6; i++) {
                const row = document.createElement('tr');

                for (let j = 0; j < 7; j++) {
                    const cell = document.createElement('td');

                    if (i === 0 && j < firstDay) {
                        cell.innerHTML = '';
                    } else if (day > daysInMonth) {
                        break;
                    } else {
                        cell.innerHTML = day;
                        cell.setAttribute('data-date', `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`);
                        day++;
                    }

                    row.appendChild(cell);
                }

                calendarTable.appendChild(row);
            }
        }

        function addTask() {
            const dateInput = document.getElementById('task-date').value;
            const taskName = document.getElementById('task-name').value;

            if (!dateInput || !taskName) {
                alert('Please enter both a date and a task name.');
                return;
            }

            const cells = calendarTable.getElementsByTagName('td');
            for (let cell of cells) {
                if (cell.getAttribute('data-date') === dateInput) {
                    const taskDiv = document.createElement('div');
                    taskDiv.className = 'task';
                    taskDiv.textContent = taskName;

                    cell.appendChild(taskDiv);
                }
            }
        }

        // Initialize the calendar
        generateCalendar();
    </script>