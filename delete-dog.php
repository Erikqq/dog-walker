<?php
require("db.php");


if (isset($_POST['delete-dog'])) {

    session_start();
    if (!isset($_SESSION['username'])) {

        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username'];
    $dogId = $_POST['delete-dog-id'];


    $dogQuery = "SELECT * FROM dogs WHERE id = $dogId AND user_id IN (SELECT id FROM users WHERE username = '$username')";
    $dogResult = mysqli_query($con, $dogQuery);

    if (mysqli_num_rows($dogResult) > 0) {

        $deleteQuery = "DELETE FROM dogs WHERE id = $dogId";
        if (mysqli_query($con, $deleteQuery)) {

            echo "A kutya sikeresen törölve lett.";
        } else {

            echo "Hiba történt a kutyatörlés során.";
        }
    } else {

        echo "Nincs jogosultságod törölni ezt a kutyát.";
    }
    header("Location: profile.php");
}
?>
