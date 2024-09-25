<?php
include "../../api/isLocal.php";

session_start();

if (isLocalhost()){
    require_once "../../api/dblocal.php";
} else {
    require_once "../../api/db.php";
}

error_reporting(E_ALL);
ini_set('display_errors', 'On');
//connectie met de database
/** @var $db */

//check of er een submit is
if(isset($_POST['submit'])){
    //omzetten naar goeie variabelen met security voor scripts
    if(empty($_POST['f_name']) || empty($_POST['l_name']) || empty($_POST['email2']) || empty($_POST['phone']) || empty($_POST['password'])) {
        $error = "Error: All fields are required.";
    } else {
        $error = '';
        // Escape and process the input
        $firstName = mysqli_real_escape_string($db, $_POST['f_name']);
        $lastName = mysqli_real_escape_string($db, $_POST['l_name']);
        $email = mysqli_real_escape_string($db, $_POST['email2']);
        $phoneNumber = mysqli_real_escape_string($db, $_POST['phone']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Further processing...
    }
    //pasword hashen en veilig maken voordat hij de database in gaat
    // in de database inserten
    $querycheckmail = "SELECT * FROM `users` WHERE email = '$email'";
    $resultcheckmail = mysqli_query($db, $querycheckmail)
    or die('Error ' . mysqli_error($db) . ' with query ' . $querycheckmail);


    if ($resultcheckmail && mysqli_num_rows($resultcheckmail) > 0) {
         $error = "Er is al een account met dit mailadres";

    } else {
        // Handle the case where no user is found or query failed
        $query = "INSERT INTO `users`(`email`, `password`, `f_name`, `l_name`, `phone`)
VALUES ('$email','$hash','$firstName','$lastName', '$phoneNumber')";
        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        $secondQuery = "SELECT `id`, `f_name` FROM `users` WHERE `email` LIKE '$email';";
        $result = mysqli_query($db, $secondQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['users_id'] = $row['id'];
            $_SESSION['user_name'] = $row['f_name'];
            header('Location: ../homepage/index.php');

        } else {
            // Handle the case where no user is found or query failed
            echo "No user found with this email or query failed.";
        }
    }



}

//database sluiten
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href="../../css/style.css">
    <link rel = "stylesheet" href="../../css/elisa.css">
    <script src="../../js/currentPage.js" defer></script>
    <title>Maak account aan</title>
</head>
<header>
    <style>
    body{
    background-color: white;
    }
    h1{
    padding-bottom: 3rem;
    }
    </style>
    <div id="meta-data-page" style="display: none;">2</div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <h1>Registreer</h1>
    <form action="" method="post">
        <div class = "input-fields">
            <div class = "input">
                <label for="f_name" class = "text-color-4">Voornaam</label>
                <input type="text" id="f_name" name="f_name" placeholder="John" required>
            </div>
            <div class = "input">
                <label for="l_name" class = "text-color-4">Achternaam</label>
                <input type="text" id="l_name" name="l_name" placeholder="Doe" required>
            </div>
            <div class = "input">
                <label for="email2" class = "text-color-4">Email adres</label>
                <input type="text" id="email2" name="email2" placeholder="user@example.com" required>
            </div>
            <div class = "input">
                <label for="phone" class = "text-color-4">Telefoonnummer</label>
                <input type="text" id="phone" name="phone" placeholder="0612345678" required>
            </div>
            <div class = "input">
                <label for="password" class = "text-color-4">Wachtwoord</label>
                <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
            </div>
        </div>
        <div id="link-register">
            <a id="link-form" href="login.php" class = "text-color-4">Heb je al een account? Log hier in.</a>
        </div>

            <div>
                <button type="submit"  name="submit" class="register-button color-3" id="button">Account maken</button>
            </div>

    </form>
    <p id="error"><?php if(isset($error)){echo $error;} ?></p>
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
