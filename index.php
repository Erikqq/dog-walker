<?php
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="js/script.js"></script>

    <link href="css/style.css" rel="stylesheet">

    <title>Főoldal</title>
</head>
<body>
<div class="container">
    <div class="row m-2">
        <div class="col p-3">
            <h1>Register</h1>
            <form action="web.php" method="post" id="registerForm">
                <div class="pt-3 field">
                    <label for="registerFirstname" class="form-label">Keresztnév</label>
                    <input type="text" class="form-control" id="registerFirstname"
                           placeholder="Keresztnév" name="firstname">
                    <small></small>
                </div>

                <div class="pt-3 field">
                    <label for="registerLastname" class="form-label">Vezetéknév</label>
                    <input type="text" class="form-control" id="registerLastname"
                           placeholder="Vezetéknév" name="lastname">
                    <small></small>
                </div>

                <div class="pt-3 field">
                    <label for="registerEmail" class="form-label">E-mail cím</label>
                    <input type="text" class="form-control" id="registerEmail"
                           placeholder="Valós email cím" name="email">
                    <small></small>
                </div>

                <div class="pt-3 field">
                    <label for="registerPassword" class="form-label">Jelszó <i class="bi bi-eye-slash-fill"
                                                                               id="passwordEye"></i></label>
                    <input type="password" class="form-control passwordVisibiliy" name="password" id="registerPassword"
                           placeholder="Jelszó (legalább 8 karakter)">
                    <small></small>
                    <span id="strengthDisp" class="badge displayBadge">Gyenge</span>
                </div>

                <div class="pt-3 field">
                    <label for="registerPasswordConfirm" class="form-label">Jelszó megerősítése</label>
                    <input type="password" class="form-control" name="passwordConfirm" id="registerPasswordConfirm"
                           placeholder="Jelszó megerősítése">
                    <small></small>
                </div>

                <div class="pt-3">
                    <input type="hidden" name="action" value="register">
                    <button type="submit" class="btn btn-primary">Regisztráció</button>
                    <button type="reset" class="btn btn-primary resetButton" >Mégsem</button>
                </div>
            </form>

            <?php
            $r = 0;

            if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
                $r = (int)$_GET["r"];

                if (array_key_exists($r, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$r] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }
            ?>
        </div>

        <div class="col bg-light p-3">
            <h1>Login</h1>
            <form action="web.php" method="post" id="loginForm">
                <div class="pt-3">
                    <label for="loginUsername" class="form-label">Felhasználónév</label>
                    <input type="text" class="form-control" id="loginUsername"
                           placeholder="Felhasználónév" name="username">
                    <small></small>
                </div>
                <div class="pt-3">
                    <label for="loginPassword" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" id="loginPassword" placeholder="Jelszó"
                           name="password">
                    <small></small>
                </div>
                <div class="pt-3">
                    <input type="hidden" name="action" value="login">
                    <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                </div>
            </form>


            <?php

            $l = 0;

            if (isset($_GET["l"]) and is_numeric($_GET['l'])) {
                $l = (int)$_GET["l"];

                if (array_key_exists($l, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$l] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }
            ?>
            <a href="#" id="fl">Elfelejtetted a jelszavad?</a>
            <form action="web.php" method="post" name="forget" id="forgetForm">
                <div class="pt-3">
                    <label for="forgetEmail" class="form-label">E-mail</label>
                    <input type="text" class="form-control" id="forgetEmail" placeholder="Email cím"
                           name="email">
                    <small></small>
                </div>
                <div class="pt-3">
                    <input type="hidden" name="action" value="forget">
                    <button type="submit" class="btn btn-primary">Jelszó visszaállítása</button>
                </div>
            </form>

            <?php

            $f = 0;

            if (isset($_GET["f"]) and is_numeric($_GET['f'])) {
                $f = (int)$_GET["f"];

                if (array_key_exists($f, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$f] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }
            ?>

        </div>

    </div>
</div>
</body>
</html>