<?php

require("db.php");
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Felhasználói Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .profile-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        .profile-info label {
            font-weight: bold;
        }

        .profile-info p {
            margin: 0;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>

<body>
<?php
    require("db.php");

    $username = $_SESSION['username'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $date = $row['create_datetime'];
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
    </div>
    <br>
    <a class="nav-link" href="logout.php">Kijelentkezés</a><br>
    <a class="nav-link" href="dashboard.php">Vissza a főoldalra</a>

</div>


<div class="container">
    <h2>Email cím módosítása</h2>
    <form action="update.php" method="POST">
        <div class="form-group">
            <label for="new-email">Új email cím:</label>
            <input type="email" id="new-email" name="new-email" required>
        </div>
        <button type="submit" name="change-email">Módosítás</button>
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

</body>
</html>
