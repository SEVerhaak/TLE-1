<?php
session_start();
/** @var mysqli $db */


// Als het inlogformulier is ingediend
if (isset($_POST['submit'])) {
    require_once "../../api/db.php";

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
        <title>Login</title>
    </head>
    <header>

    </header>
    <body>
    <nav>
        <a href = "../homepage"><img src="../../images/arrow.png" alt="Menu"></a>
    </nav>
    <main>
        <form action="" method="post">
            <div class = "input-fields">
                <div class = "input">
                    <label for="email"></label>
                    <input type="text" id="email" name="email" placeholder="Email" required>
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
            </div>
            <div class = "buttons">
                <div>
                    <button class="button" type="submit" name="submit">Inloggen</button>
                </div>
                <div id="link-account">
                    <a id="link-form" href="register.php">Geen account? Maak er een aan.</a>
                </div>
            </div>
        </form>

    </main>

    </body>
    </html>
<?php
