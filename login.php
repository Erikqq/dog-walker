<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();

    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;

            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Ismeretlen jelszó és név páros.</h3><br/>
                  <p class='link'>Kattints ide az ismételt <a href='login.php'>bejelentkezéshez</a>.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Bejelentkezés</h1>
        <input type="text" class="login-input" name="username" placeholder="Felhasználónév" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Jelszó"/>
        <input type="submit" value="Bejelentkezés" name="submit" class="login-button"/>
        <p class="link">Még nincs felhasználód? <a href="registration.php">Regisztrálj most!</a></p>
  </form>
<?php
    }
?>
</body>
</html>
