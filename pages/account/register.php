<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'On');
//connectie met de database
/** @var $db */
require_once "../../api/db.php";
//check of er een submit is
if(isset($_POST['submit'])){
    //omzetten naar goeie variabelen met security voor scripts
    if(empty($_POST['f_name']) || empty($_POST['l_name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['password'])) {
        $error = "Error: All fields are required.";
    } else {
        $error = '';
        // Escape and process the input
        $firstName = mysqli_real_escape_string($db, $_POST['f_name']);
        $lastName = mysqli_real_escape_string($db, $_POST['l_name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $phoneNumber = mysqli_real_escape_string($db, $_POST['phone']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Further processing...
    }
    //pasword hashen en veilig maken voordat hij de database in gaat
    // in de database inserten

    $query = "INSERT INTO `users`(`email`, `password`, `f_name`, `l_name`, `phone`)
VALUES ('$email','$hash','$firstName','$lastName', '$phoneNumber')";
    $result = mysqli_query($db, $query)
    or die('Error ' . mysqli_error($db) . ' with query ' . $query);

    $secondQuery = "SELECT `id` FROM `users` WHERE `email` LIKE '$email';";
    $result = mysqli_query($db, $secondQuery);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['users_id'] = $row['id'];

        echo $_SESSION['users_id'];
        //header('Location: ../homepage/index.php');

    } else {
        // Handle the case where no user is found or query failed
        echo "No user found with this email or query failed.";
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
    <title>Maak account aan</title>
</head>
<header>

<body>
<nav>
    <a href = "../homepage"><img src="../../images/arrow.png" alt="Menu"></a>
</nav>
<main>
    <form action="" method="post">
        <div class = "input-fields">
            <div class = "input">
                <label for="f_name"></label>
                <input type="text" id="f_name" name="f_name" placeholder="Voornaam" required>
            </div>
            <div class = "input">
                <label for="l_name"></label>
                <input type="text" id="l_name" name="l_name" placeholder="Achternaam" required>
            </div>
            <div class = "input">
                <label for="email"></label>
                <input type="text" id="email" name="email" placeholder="Email" required>
            </div>
            <div class = "input">
                <label for="phone"></label>
                <input type="text" id="phone" name="phone" placeholder="Telefoonnummer" required>
            </div>
            <div class = "input">
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
            </div>
        </div>


        <div class = "buttons">
            <div>
                <button type="submit"  name="submit" class="button" id="button">Account maken</button>
            </div>
            <div id="link-account">
                <a id="link-form" href="login.php">Heb je al een account? Log hier in.</a>
            </div>
        </div>
    </form>
    <p id="error"><?php if(isset($error)){echo $error;} ?></p>
</main>
</body>
</html>
