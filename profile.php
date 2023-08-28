<?php

require("db_config.php");
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Felhasználói Profil</title>
    <link rel="stylesheet" href="css/profile-style.css">
</head>

<body>

<?php

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
        $isAdmin = true;
    } else {
        $isAdmin = false;
    }
} else {
    $isAdmin = false;
}
?>

<?php
    require("db_config.php");

    $username = $_SESSION['username'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $date = $row['create_datetime'];
        $description = $row['description'];
    }
?>

<div class="container">
    <h1>Felhasználói Profil</h1>
    <div class="profile-info">
        <div>
            <label>Felhasználónév:</label>
            <p id="username"><?php echo $username; ?></p>
        </div>
        <div>
            <label>Email:</label>
            <p id="email"><?php echo $email; ?></p>
        </div>
        <div>
            <label>Regisztráció dátuma:</label>
            <p id="email"><?php echo $date; ?></p>
        </div>
        <div>
            <label>Leírás</label>
            <p id="description"><?php echo $description; ?></p>
        </div>

    </div>
    <br>
    <a class="nav-link" href="logout.php">Kijelentkezés</a><br>
    <a class="nav-link" href="dashboard.php">Vissza a főoldalra</a><br>
    <?php if ($isAdmin): ?>
        <a href="admin.php">Admin oldal</a>
    <?php endif; ?>

</div>


<div class="container">
    <h2>Adatok módosítása</h2>
    <form action="update.php" method="POST">
        <div class="form-group">
            <label for="new-email">Új email cím:</label><br>
            <input type="email" id="new-email" name="new-email" required>
        </div>
        <button type="submit" name="change-email">Módosítás</button>
    </form>
    <br>
    <form action="update.php" method="POST">
        <div class="form-group">
            <label for="new-description">Új leírás:</label><br>
            <textarea name="new-description" id="new-description" required></textarea>
        </div>
        <button type="submit" name="change-description">Módosítás</button>
    </form>
</div>

<div class="container">
    <h2>Kutya regisztrálása</h2>
    <form action="add_dog.php" method="POST">
        <div class="form-group">
            <label for="breed">Fajta:</label>
            <input type="text" id="breed" name="breed" required>
        </div>
        <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="comment">Megjegyzés:</label>
            <textarea id="comment" name="comment"></textarea>
        </div>
        <button type="submit">Hozzáadás</button>
    </form>
</div>

<div class="container">
    <h2>Kutyáid listája</h2>

    <?php

    $username = $_SESSION['username'];


    $dogsQuery = "SELECT * FROM dogs WHERE user_id IN (SELECT id FROM users WHERE username = '$username')";
    $dogsResult = mysqli_query($con, $dogsQuery);


    if (mysqli_num_rows($dogsResult) > 0) {

        while ($row = mysqli_fetch_assoc($dogsResult)) {
            $dogId = $row['id'];
            $breed = $row['breed'];
            $name = $row['name'];
            $comment = $row['comment'];


            echo "<div class='dog-item'>";
            echo "    <div class='dog-info'>";
            echo "<br>";
            echo "        <span class='label'>ID:</span> $dogId<br>";
            echo "        <span class='label'>Fajta:</span> $breed<br>";
            echo "        <span class='label'>Név:</span> $name<br>";
            echo "        <span class='label'>Megjegyzés:</span> $comment<br>";
            echo "    </div>";
            echo "</div>";
        }
    } else {

        echo "<div class='no-dogs'>Jelenleg nincs regisztrált kutyád.</div>";
    }
    ?>
</div>


<div class="container">
    <h2>Kutya törlése</h2>
    <form action="delete-dog.php" method="POST">
        <div class="form-group">
            <label for="delete-dog-id">Kutya ID:</label>
            <input type="text" id="delete-dog-id" name="delete-dog-id" required>
        </div>
        <button type="submit" name="delete-dog">Törlés</button>
    </form>
</div>

<div class="container">
    <h2>Sétáltatás</h2>
    <h3>Új sétáltatás feladása</h3>
    <form action="processwalk.php" class="contact-form" method="POST">
        <label for="dog_id">Válassz egy kutyát:</label>
        <select id="dog_id" name="dog_id">
            <?php
        
        
        	
        
            require("db_config.php");

            $username = $_SESSION['username'];

            $getUserQuery = "SELECT id FROM users WHERE username = '$username'";
            $userResult = mysqli_query($con, $getUserQuery);
            $userData = mysqli_fetch_assoc($userResult);
            $user_id = $userData['id'];

            $getDogsQuery = "SELECT id, name FROM dogs WHERE user_id = '$user_id'";
            $dogsResult = mysqli_query($con, $getDogsQuery);

            while ($dogData = mysqli_fetch_assoc($dogsResult)) {
                echo "<option value='" . $dogData['id'] . "'>" . $dogData['name'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="day">Dátum és idő:</label>
        <input type="datetime-local" id="day" name="day" required><br><br>

        <label for="message">Üzenet:</label><br>
        <textarea id="message" name="message" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Kérés Elküldése">
        

        
    </form>
    <h3>Meglévő sétáltatások</h3>
    <?php
    $query = "SELECT * FROM walks WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    ?>
    <table>
        <tr>
            <th>Sétáltatás ID</th>
            <th>Kutya ID</th>
            <th>Dátum</th>
            <th>Küldött üzenet</th>
            <th>Készítve</th>
            <th>Elfogadva</th>
            <th>Sétáltató</th>
            <th>Válaszüzenet</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['dog_id'] . "</td>";
            echo "<td>" . $row['day'] . "</td>";
            echo "<td>" . $row['message'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>" . $row['accepted_at'] . "</td>";
            echo "<td>" . $row["walker_id"] . "</td>";
            echo "<td>" . $row['response'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>



    <h3>Sétáltatók értékelése</h3>
    <form action="rate.php" method="POST">
        Sétáltatás ID
        <select name="walk_id">
            <?php

            $acceptedWalksQuery = "SELECT * FROM walks WHERE user_id = '$user_id' AND accepted_at IS NOT NULL AND rated = 0";
            $acceptedWalksResult = mysqli_query($con, $acceptedWalksQuery);

            while ($walk = mysqli_fetch_assoc($acceptedWalksResult)) {
                echo "<option value='" . $walk['id'] . "'>" . $walk['id'] . "</option>";
            }
            ?>
        </select><br>
        Értékelés (1-5)
        <input type="number" name="rating" min="1" max="5" required><br>
        <button type="submit" name="rate">Értékelés</button>
    </form>
</div>


<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$checkAdminQuery = "SELECT adminlevel, wants_to_be_walker FROM users WHERE username = '$username'";
$adminResult = mysqli_query($con, $checkAdminQuery);

if (mysqli_num_rows($adminResult) == 1) {
    $row = mysqli_fetch_assoc($adminResult);
    $adminLevel = $row['adminlevel'];
    $wantsToBeWalker = $row['wants_to_be_walker'];
}
?>

<div class="container">
    <h3>Sétáltató kérelem</h3>
    <?php if ($adminLevel > 0): ?>
        <?php if ($wantsToBeWalker == 0): ?>
            <p>Te már sétáltató vagy.</p>
        <?php else: ?>
            <p>Jelentkeztél sétáltatónak.</p>
        <?php endif; ?>
    <?php else: ?>
        <?php if ($wantsToBeWalker == 0): ?>
            <p>Nem vagy még sétáltató. Jelentkezz sétáltatónak!</p>
            <form action="set_wants_to_be_walker.php" method="POST">
                <button type="submit" name="set-walker">Jelentkezés sétáltatónak</button>
            </form>
        <?php else: ?>
            <p>Jelentkeztél sétáltatónak. Szeretnéd visszavonni?</p>
            <form action="set_wants_to_be_walker.php" method="POST">
                <button type="submit" name="unset-walker">Jelentkezés visszavonása</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>


</body>
</html>
