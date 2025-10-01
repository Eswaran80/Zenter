<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    /* Background overlay */
    .overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
    }

    /* Form modal */
    .form-container {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      width: 350px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .form-container h2 {
      margin-top: 0;
    }

    .form-container input {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
    }

    .btn {
      padding: 8px 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-save {
      background: #28a745;
      color: white;
    }

    .btn-cancel {
      background: #dc3545;
      color: white;
    }
  </style>
</head>
<body>
  <button onclick="openForm()">Edit User</button>

  <div class="overlay" id="editFormOverlay">
    <div class="form-container">
      <h2>Edit User</h2>
      <form>
        <input type="text" placeholder="Username" required>
        <input type="email" placeholder="Email" required>
        <input type="text" placeholder="Role">
        <div class="form-actions">
          <button type="submit" class="btn btn-save">Save</button>
          <button type="button" class="btn btn-cancel" onclick="closeForm()">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openForm() {
      document.getElementById("editFormOverlay").style.display = "flex";
    }

    function closeForm() {
      document.getElementById("editFormOverlay").style.display = "none";
    }
  </script>
</body>
</html>
