<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require("db_config.php");

$username = $_SESSION['username'];


$checkAdminQuery = "SELECT adminlevel FROM users WHERE username = '$username'";
$adminResult = mysqli_query($con, $checkAdminQuery);

if (mysqli_num_rows($adminResult) == 1) {
    $row = mysqli_fetch_assoc($adminResult);
    $adminLevel = $row['adminlevel'];


    if ($adminLevel > 0) {
        if($adminLevel == 2){
            $isAdmin2 = true;
        } else{
            $isAdmin2 = false;
        }

    } else {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['walk_id']) && isset($_POST['response_message'])) {
        $walk_id = $_POST['walk_id'];
        $response_message = $_POST['response_message'];
        $accepted_at = date("Y-m-d H:i:s");


        $userQuery = "SELECT id FROM users WHERE username = '$username'";
        $userResult = mysqli_query($con, $userQuery);
        $userData = mysqli_fetch_assoc($userResult);
        $walker_id = $userData['id'];


        $updateQuery = "UPDATE walks SET response = '$response_message', walker_id = '$walker_id', accepted_at = '$accepted_at' WHERE id = '$walk_id'";
        $updateResult = mysqli_query($con, $updateQuery);

        $updateWalkedDogsQuery = "UPDATE users SET walked_dogs = walked_dogs + 1 WHERE username = '$username'";
        mysqli_query($con, $updateWalkedDogsQuery);

        if ($updateResult) {
            $message = "Sétáltatás kérés sikeresen frissítve.";
        } else {
            $message = "Hiba történt a sétáltatás kérés frissítésekor.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Oldal</title>
    <link rel="stylesheet" href="css/admin-styles.css">
</head>
<body>
<div class="navbar">
    <div class="welcome-text">
        <h2>Üdvözöllek, <?php echo $username; ?>!</h2>
    </div>

    <a href="orders.php" class="nav-link">Megrendelések</a>
    <?php if ($isAdmin2): ?>
        <a href="admin.php" class="nav-link">Felhasználók</a>
        <a href="workers.php" class="nav-link">Munkások kezelése</a><?php endif; ?>
    <a href="dashboard.php" class="nav-link">Kijelentkezés</a>
</div>

<div class="content">
        <h2>Sétáltatási Kérések</h2>
        <table>
            <tr>
                <th>Walk ID</th>
                <th>Dog ID</th>
                <th>User ID</th>
                <th>Walker ID</th>
                <th>Day</th>
                <th>Message</th>
                <th>Created At</th>
                <th>Accepted At</th>
                <th>Response</th>
            </tr>
            <?php

            $query = "SELECT * FROM walks";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['dog_id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['walker_id'] . "</td>";
                echo "<td>" . $row['day'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>" . $row['accepted_at'] . "</td>";
                echo "<td>" . $row['response'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>

    <h2>Sétáltatás Kérés Elfogadása</h2>
    <form action="" method="POST">
        <label for="walk_id">Walk ID:</label>
        <input type="text" id="walk_id" name="walk_id" required><br>

        <label for="response_message">Válaszüzenet:</label>
        <textarea id="response_message" name="response_message" required></textarea><br>

        <button type="submit">Mentés</button>
    </form>
</div>
</body>
</html>
