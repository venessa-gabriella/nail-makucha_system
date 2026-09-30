<?php
session_start();
include "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM nails ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Nail Records</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f5f5f5;
        }

        .container {
            width: 90%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: green;
            color: white;
        }

        .edit {
            background-color: blue;
            color: white;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .delete {
            background-color: red;
            color: white;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .add {
            background-color: green;
            color: white;
            padding: 10px;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Nail Service Records</h2>

    <a href="add_nail.php" class="add">Add New Service</a>

    <table>

        <tr>
            <th>ID</th>
            <th>Client Name</th>
            <th>Nail Service</th>
            <th>Price</th>
            <th>Technician</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

        ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['client_name']; ?></td>

            <td><?php echo $row['nail_service']; ?></td>

            <td><?php echo $row['price']; ?></td>

            <td><?php echo $row['technician']; ?></td>

            <td><?php echo $row['appointment_date']; ?></td>

            <td>

                <a class="edit"
                   href="edit.php?id=<?php echo $row['id']; ?>">
                   Edit
                </a>

                <a class="delete"
                   href="delete.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this record?');">
                   Delete
                </a>

            </td>

        </tr>

        <?php

            }

        } else {

        ?>

        <tr>
            <td colspan="7">No nail records found.</td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>