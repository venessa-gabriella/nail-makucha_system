<?php
session_start();
include "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Nail record ID not provided.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM nails WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Nail record not found.");
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $client_name = $_POST['client_name'];
    $nail_service = $_POST['nail_service'];
    $price = $_POST['price'];
    $technician = $_POST['technician'];
    $appointment_date = $_POST['appointment_date'];

    $sql = "UPDATE nails SET
            client_name = '$client_name',
            nail_service = '$nail_service',
            price = '$price',
            technician = '$technician',
            appointment_date = '$appointment_date'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Record updated successfully!');
                window.location.href='view.php';
              </script>";

        exit();

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Nail Service</title>

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
            background-color: blue;
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

    <h2>Edit Nail Service</h2>

    <form method="POST">

        <label>Client Name:</label>

        <input type="text"
               name="client_name"
               value="<?php echo htmlspecialchars($row['client_name']); ?>"
               required>


        <label>Nail Service:</label>

        <select name="nail_service" required>

            <option value="Manicure"
                <?php if ($row['nail_service'] == "Manicure") echo "selected"; ?>>
                Manicure
            </option>

            <option value="Pedicure"
                <?php if ($row['nail_service'] == "Pedicure") echo "selected"; ?>>
                Pedicure
            </option>

            <option value="Gel Nails"
                <?php if ($row['nail_service'] == "Gel Nails") echo "selected"; ?>>
                Gel Nails
            </option>

            <option value="Acrylic Nails"
                <?php if ($row['nail_service'] == "Acrylic Nails") echo "selected"; ?>>
                Acrylic Nails
            </option>

            <option value="Nail Art"
                <?php if ($row['nail_service'] == "Nail Art") echo "selected"; ?>>
                Nail Art
            </option>

        </select>


        <label>Price:</label>

        <input type="number"
               name="price"
               step="0.01"
               value="<?php echo $row['price']; ?>"
               required>


        <label>Technician:</label>

        <input type="text"
               name="technician"
               value="<?php echo htmlspecialchars($row['technician']); ?>"
               required>


        <label>Appointment Date:</label>

        <input type="date"
               name="appointment_date"
               value="<?php echo $row['appointment_date']; ?>"
               required>


        <button type="submit" name="update">
            Update Service
        </button>

    </form>

    <a href="view.php">Back to Records</a>

</div>

</body>
</html>