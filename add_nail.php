<?php
session_start();
include "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['save'])) {

    $client_name = $_POST['client_name'];
    $nail_service = $_POST['nail_service'];
    $price = $_POST['price'];
    $technician = $_POST['technician'];
    $appointment_date = $_POST['appointment_date'];

    $sql = "INSERT INTO nails
            (client_name, nail_service, price, technician, appointment_date)
            VALUES
            ('$client_name', '$nail_service', '$price', '$technician', '$appointment_date')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Nail service saved successfully!');
                window.location.href='view.php';
              </script>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Nail Service</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f5f5f5;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: green;
            color: white;
            border: none;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Add Nail Service</h2>

    <form method="POST">

        <label>Client Name:</label>
        <input type="text" name="client_name" required>

        <label>Nail Service:</label>
        <select name="nail_service" required>
            <option value="">Select Service</option>
            <option value="Manicure">Manicure</option>
            <option value="Pedicure">Pedicure</option>
            <option value="Gel Nails">Gel Nails</option>
            <option value="Acrylic Nails">Acrylic Nails</option>
            <option value="Nail Art">Nail Art</option>
        </select>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" required>

        <label>Technician:</label>
        <input type="text" name="technician" required>

        <label>Appointment Date:</label>
        <input type="date" name="appointment_date" required>

        <button type="submit" name="save">Save Service</button>

    </form>

    <a href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>