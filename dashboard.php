<?php

include("auth_session_guest.php");
require("db_config.php");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kutyasétáltatás</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>


<header>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Kutyasétáltatás</a>
        <ul class="nav-links">

			<li class="nav-item">
            	<a class="nav-link" href="walkers.php">Sétáltatók</a>
            </li>

            <?php
            if ($_SESSION['username'] == "Vendég") {
                echo '<li class="nav-item">
                    <a class="nav-link" href="registration.php">Regisztráció</a>
                </li>';
            } else {
                echo '<li class="nav-item">
                    <a class="nav-link" href="profile.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Kijelentkezés</a>
                </li>';
            }
            ?>


        </ul>
    </nav>
</header>

<section id="about" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-content">
                    <h2 class="section-heading">Rólunk</h2>
                    <p>Az oldal lehetőséget biztosít kutyáid sétáltatására, esetleg kutyasétáltatónak való jelentkezésre.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-content">
                    <h2 class="section-heading">Szolgáltatások</h2>
                    <ul>
                        <li>Kutyasétáltatás</li>
                        <li>Etetés</li>
                        <li>Játszás</li>
                        <li>Orvosi vizsgálat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-content">
                    <h2 class="section-heading">Kapcsolat</h2>
                    <p>Írj nekünk: info@kutyasetaltatas.hu</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="workers" class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-content">
                    <h2 class="section-heading">Kutyasétáltatók</h2>
                    <?php
                    require("db_config.php");


                    $adminUsersQuery = "SELECT id, username, description, rating, rates, email, walked_dogs FROM users WHERE adminlevel = 1";
                    $adminUsersResult = mysqli_query($con, $adminUsersQuery);


                    $adminUsers = array();


                    while ($row = mysqli_fetch_assoc($adminUsersResult)) {
                        $rating = $row['rating'];
                        $rates = $row['rates'];


                        if ($rates != 0) {
                            $averageRating = $rating / $rates;
                        } else {
                            $averageRating = 0;
                        }

                        $adminUsers[] = array(
                            'id' => $row['id'],
                            'email' => $row['email'],
                            'username' => $row['username'],
                            'description' => $row['description'],
                            'averageRating' => $averageRating,
                            'walked_dogs' => $row['walked_dogs']
                        );
                    }


                    usort($adminUsers, function ($a, $b) {
                        return $b['averageRating'] - $a['averageRating'];
                    });


                    echo "<h2>Top 5 sétáltató felhasználó értékelése:</h2>";
                    echo "<ul>";
                    for ($i = 0; $i < min(5, count($adminUsers)); $i++) {
                        echo "<li><b>Sétáltató:</b> " . $adminUsers[$i]['username'] . " - <b>Átlagos értékelése:</b> " . $adminUsers[$i]['averageRating'] . " - <b>Leírása:</b> " . $adminUsers[$i]['description'] . " - <b>Elérhetősége:</b> " . $adminUsers[$i]['email'] . " - <b>Megsétáltatott kutyák száma:</b> " . $adminUsers[$i]['walked_dogs'] . "</li>";
                    }
                    echo "</ul>";

                    echo "<h2>Top 5 sétáltató felhasználó (legtöbb kutyát megsétáltatta):</h2>";
                    echo "<ul>";
                    for ($i = 0; $i < min(5, count($adminUsers)); $i++) {
                        echo "<li><b>Sétáltató:</b> " . $adminUsers[$i]['username'] . " - <b>Átlagos értékelése:</b> " . $adminUsers[$i]['averageRating'] . " - <b>Leírása:</b> " . $adminUsers[$i]['description'] . " - <b>Elérhetősége:</b> " . $adminUsers[$i]['email'] . " - <b>Megsétáltatott kutyák száma:</b> " . $adminUsers[$i]['walked_dogs'] . "</li>";
                    }
                    echo "</ul>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


<footer class="footer">
    <div class="container">
        <p>© 2023 Kutyasétáltatás. Minden jog fenntartva.</p>
    </div>
</footer>

</body>
</html>

