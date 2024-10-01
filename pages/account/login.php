<?php
include "../../api/isLocal.php";

session_start();

$dbLocation = '';

if (isLocalhost()){
    $dbLocation = '../../api/dblocal.php';
} else {
    $dbLocation = '../../api/db.php';
}

require_once $dbLocation;

/** @var mysqli $db */

$error = '';

if (isset($_GET['error'])) {
    $error = 'Je moet ingelogd hiervoor zijn!';
}

// Als het inlogformulier is ingediend
if (isset($_POST['submit'])) {

    // Ontvang de ingediende gegevens
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Zoek de gebruiker in de database op basis van het e-mailadres
    $query = "SELECT * FROM `users` WHERE email = '$email';";
    $result = mysqli_query($db, $query);

    // Controleer of de gebruiker bestaat
    if (mysqli_num_rows($result) == 1) {
        // Haal de gebruikersgegevens op
        $user = mysqli_fetch_assoc($result);

        // Controleer of het verstrekte wachtwoord overeenkomt met het opgeslagen wachtwoord in de database
        if (password_verify($password, $user['password'])) {
            // Gebruiker succesvol ingelogd
            $_SESSION['users_id'] = $user['id'];
            $_SESSION['user_name'] = $user['f_name'];


                header('Location: ../homepage/index.php');
                exit();

        } else {
            // Ongeldige inloggegevens
            $errors['loginFailed'] = "Onjuiste inloggegevens. Probeer opnieuw.";
        }
    } else {
        // Gebruiker niet gevonden in de database
        $errors['loginFailed'] = "Gebruiker is niet gevonden";
    }
}
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/elisa.css">
        <script src="../../js/currentPage.js" defer></script>
        <title>Login</title>
    </head>
    <header>
        <div id="meta-data-page" style="display: none;">2</div>
    </header>
    <style>
        body{
            background-color: white;
        }
        h1{
            padding-bottom: 4rem;
        }
    </style>
    <?php include('../../includes/nav.php'); ?>
    <body>

    <main>
        <h1>Login</h1>
        <div class="stripe"> </div>
        <form action="" method="post">
            <div class = "input-fields">
                <div class = "input">
                    <label for="email"></label>
                    <input type="text" id="email" name="email" placeholder="user@example.com" required>
                </div>
                <?php if(isset($errors['loginFailed'])) { ?>
                    <div class="notification is-danger">
                        <?=$errors['loginFailed']?>
                    </div>
                <?php } ?>
                <div class = "input">
                    <label for="password"></label>
                    <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
                </div>
                <div class = "checkbox">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember" class = "text-color-4"> Onthoud mijn gegevens</label>
                </div>
            </div>
            <div id="link-account">
                <a id="link-form" href="register.php" class = "text-color-4">Nog geen account? Maak er een aan!</a>
            </div>
            <p style="color: red;"><?= $error ?></p>
                <div>
                    <button class="login-button color-3" type="submit" name="submit">Login</button>
                </div>

        </form>

    </main>
    <?php include('../../includes/footer.php'); ?>
    </body>
    </html>
<?php
