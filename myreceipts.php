<?php
include 'config.php';
session_start();

if (!isset($_SESSION["usermail"]) || $_SESSION["usermail"] == "") {
    header("Location: index.php");
    exit();
}

$userEmail = $_SESSION['usermail'];
$sql = "SELECT * FROM payment WHERE Email = '$userEmail' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Receipts - BlueBird Hotel</title>
    <link rel="stylesheet" href="./css/home.css"> <!-- Same CSS as home.php -->
    <style>
        .container { margin: 100px auto; width: 90%; }
        h1 { text-align: center; margin-bottom: 30px; }
        table { border-collapse: collapse; width: 100%; background: white; box-shadow: var(--bg-box-shadow); }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #0040ff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }
    </style>
</head>
<body>

<!-- Navbar copied exactly from home.php -->
<nav>
    <div class="logo">
      <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo">
      <p>BLUEBIRD</p>
    </div>
    <ul>
      <li><a href="home.php">Home</a></li>
    </ul>
  </nav>


<div class="container">
    <h1>My Receipts</h1>
    <table>
        <tr>
            <th>Receipt ID</th>
            <th>Room Type</th>
            <th>Bed</th>
            <th>Meal</th>
            <th>No. of Rooms</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>No. of Days</th>
            <th>Total Amount</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['RoomType']}</td>
                        <td>{$row['Bed']}</td>
                        <td>{$row['meal']}</td>
                        <td>{$row['NoofRoom']}</td>
                        <td>{$row['cin']}</td>
                        <td>{$row['cout']}</td>
                        <td>{$row['noofdays']}</td>
                        <td>Rs. {$row['finaltotal']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No receipts found.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
