<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Add User Personal Details</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.98);
            border-radius: 12px;
            padding: 30px 35px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .form-container h2 {
            text-align: center;
            color: #0b3d91;
            font-size: 26px;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            color: #0b3d91;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #0b3d91;
            outline: none;
            box-shadow: 0 0 5px rgba(11, 61, 145, 0.5);
        }

        .gender-group {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .gender-group label {
            font-weight: normal;
            color: #0b3d91;
            display: flex;
            align-items: center;
        }

        .gender-group input {
            margin-right: 6px;
            accent-color: #0b3d91;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .button-group button {
            width: 48%;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-add {
            background-color: #0b3d91;
            color: #fff;
        }

        .btn-add:hover {
            background-color: #0a357a;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        @media (max-width: 420px) {
            .button-group {
                flex-direction: column;
            }

            .button-group button {
                width: 100%;
                margin-bottom: 12px;
            }

            .button-group button:last-child {
                margin-bottom: 0;
            }
        }
    </style>

</head>

<body>

    <div class="form-container">
        <h2><i class="fas fa-user-plus"></i> Add User Personal Details</h2>

        <form action="#" method="POST">

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe" required>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <div class="gender-group">
                    <label><input type="radio" name="gender" value="Male" required> Male</label>
                    <label><input type="radio" name="gender" value="Female" required> Female</label>
                    <label><input type="radio" name="gender" value="Other" required> Other</label>
                </div>
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" min="1" max="120" placeholder="30" required>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" placeholder="1234567890" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="City, Address" required>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-add"><i class="fas fa-plus"></i> Add User</button>
                <button type="reset" class="btn-cancel"><i class="fas fa-times"></i> Cancel</button>
            </div>

        </form>
    </div>

</body>

</html>
