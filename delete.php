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

$sql = "DELETE FROM nails WHERE id = $id";

if (mysqli_query($conn, $sql)) {

    echo "<script>
            alert('Record deleted successfully!');
            window.location.href='view.php';
          </script>";

    exit();

} else {

    echo "Error: " . mysqli_error($conn);

}
?>