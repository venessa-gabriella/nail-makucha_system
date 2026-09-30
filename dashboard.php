<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nail Salon Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f5f5f5;
        }

        .container {
            width: 500px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
        }

        a {
            display: block;
            padding: 12px;
            margin: 10px;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout {
            background-color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Nail Salon Management System</h2>

    <p>Welcome, <?php echo $_SESSION['username']; ?></p>

    <a href="add_nail.php">Add Nail Service</a>

    <a href="view.php">View Nail Records</a>

    <a href="logout.php" class="logout">Logout</a>

</div>

</body>
</html>