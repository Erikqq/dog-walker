<?php
require("db.php");
include("auth_session.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['breed']) && isset($_POST['name'])) {
        $breed = $_POST['breed'];
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $username = $_SESSION['username'];

        $userQuery = "SELECT id FROM users WHERE username = '$username'";
        $userResult = mysqli_query($con, $userQuery);
        $userData = mysqli_fetch_assoc($userResult);
        $user_id = $userData['id'];

        $insertQuery = "INSERT INTO dogs (user_id, breed, name, comment) VALUES ('$user_id', '$breed', '$name', '$comment')";
        $insertResult = mysqli_query($con, $insertQuery);

        if ($insertResult) {
            $message = "A kutya adatai sikeresen hozzáadva lettek.";
        } else {
            $message = "Hiba történt a kutya adatainak hozzáadásakor.";
        }

        header("Location: profile.php");
        exit();
    }
}
?>
