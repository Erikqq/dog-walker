<?php

include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kutyasétáltatás</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<header>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Kutyasétáltatás</a>
        <ul class="nav-links">
            <li class="nav-item">
                <a class="nav-link" href="#about">Rólunk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#services">Szolgáltatások</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contact">Kapcsolat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Kijelentkezés</a>
            </li>
        </ul>
    </nav>
</header>

<section id="about" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-content">
                    <h2 class="section-heading">Rólunk</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor eleifend elit, eu porttitor leo molestie ut. Fusce accumsan nisi sit amet elit sollicitudin tincidunt. Integer nec ligula vitae enim auctor ultricies.</p>
                </div>
            </div>
            <div class="col-md-6">
                <img src="img/1.jpg" alt="Kép" class="section-image">
            </div>
        </div>
    </div>
</section>

<section id="services" class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="img/2.jpg" alt="Kép" class="section-image">
            </div>
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
            <div class="col-md-6">
                <img src="img/3.jpg" alt="Kép" class="section-image">
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <p>&copy; 2023 Kutyasétáltatás. Minden jog fenntartva.</p>
    </div>
</footer>

</body>
</html>

