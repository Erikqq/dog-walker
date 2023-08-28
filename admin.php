<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require("db_config.php");

$username = $_SESSION['username'];

// Checking admin level
$checkAdminQuery = "SELECT adminlevel FROM users WHERE username = '$username'";
$adminResult = mysqli_query($con, $checkAdminQuery);

if (mysqli_num_rows($adminResult) == 1) {
    $row = mysqli_fetch_assoc($adminResult);
    $adminLevel = $row['adminlevel'];

    // Check if user has admin level 2
    if ($adminLevel > 0) {
        if($adminLevel == 2){
            $isAdmin2 = true;
        } else{
            $isAdmin2 = false;
            header("Location: orders.php");
        }

    } else {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}




if (isset($_POST['targetUserId']) && isset($_POST['action'])) {
    $targetUserId = mysqli_real_escape_string($con, $_POST['targetUserId']);
    $action = mysqli_real_escape_string($con, $_POST['action']);

    if ($action === "kitiltas") {
        $updateBanQuery = "UPDATE users SET banned = 1 WHERE id = '$targetUserId'";
        if (mysqli_query($con, $updateBanQuery)) {
            echo "<script>
                alert('Felhasználó kitiltva.');
                window.location.href = 'admin.php';
              </script>";
        } else {
            echo "<script>
                alert('Kitiltás sikertelen.');
                window.location.href = 'admin.php';
              </script>";
        }
    } elseif ($action === "feloldas") {
        $updateBanQuery = "UPDATE users SET banned = 0 WHERE id = '$targetUserId'";
        if (mysqli_query($con, $updateBanQuery)) {
            echo "<script>
                alert('Kitiltás feloldva.');
                window.location.href = 'admin.php';
              </script>";
        } else {
            echo "<script>
                alert('Feloldás sikertelen.');
                window.location.href = 'admin.php';
              </script>";
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
        <a class="nav-link">Felhasználók</a>
    <a href="workers.php" class="nav-link">Munkások kezelése</a><?php endif; ?>
    <a href="dashboard.php" class="nav-link">Kijelentkezés</a>
</div>

<div class="content">
    <h1>Felhasználók</h1>
    <div class="content-2">
        <table>
            <tr>
                <th>ID</th>
                <th>Felhasználónév</th>
                <th>Email</th>
                <th>Létrehozás dátuma</th>
                <th>Admin szint</th>
                <th>Kitiltva</th>
            </tr>
            <?php
            // SQL connect
            require("db_config.php");
            $userQuery = "SELECT id, username, email, create_datetime, adminlevel, banned FROM users";
            $userResult = mysqli_query($con, $userQuery);

            while ($row = mysqli_fetch_assoc($userResult)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['create_datetime'] . "</td>";
                echo "<td>" . $row['adminlevel'] . "</td>";
                echo "<td>" . $row['banned'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
        <div class="content-2">
            <h2>Felhasználó Kitiltása vagy Feloldása</h2>
            <form action="" method="POST">
                <label for="targetUserId">Cél felhasználó ID:</label>
                <input type="text" id="targetUserId" name="targetUserId" required>
                <label for="action">Művelet:</label>
                <select id="action" name="action" required>
                    <option value="kitiltas">Kitiltás</option>
                    <option value="feloldas">Feloldás</option>
                </select>
                <button type="submit">Oké</button>
            </form>
        </div>
</div>
</body>
</html>
