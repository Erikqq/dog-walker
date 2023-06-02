<?php
require("db.php");


if (isset($_POST['change-email'])) {

    session_start();
    if (!isset($_SESSION['username'])) {

        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username'];
    $newEmail = $_POST['new-email'];


    $updateQuery = "UPDATE users SET email = '$newEmail' WHERE username = '$username'";

    if (mysqli_query($con, $updateQuery)) {

        echo "Az email cím sikeresen meg lett változtatva.";
    } else {

        echo "Hiba történt az email cím módosítása során.";
    }
}
?>
