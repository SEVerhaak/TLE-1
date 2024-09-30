<?php
session_start();
require_once "../../api/isLocal.php";

$dbLocation = '';

if (isLocalhost()){
    $dbLocation = '../../api/dblocal.php';
} else {
    $dbLocation = '../../api/db.php';
}

require_once $dbLocation;

/** @var mysqli $db */

// Check if the user is logged in
if (!isset($_SESSION['users_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch the user's data from the database
$user_id = $_SESSION['users_id'];
$query = "SELECT `email`, `f_name`, `l_name`, `phone` FROM `users` WHERE `id` = '$user_id'";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User data not found.";
    exit();
}

// Voeg vrienden toe op basis van ID
$friend_added = false;
if (isset($_POST['search'])) {
    $friend_id = mysqli_real_escape_string($db, $_POST['friend_id']);

    // Controleer of de vriend bestaat
    $friend_query = "SELECT `id`, `f_name`, `l_name` FROM `users` WHERE `id` = '$friend_id'";
    $friend_result = mysqli_query($db, $friend_query);

    if ($friend_result && mysqli_num_rows($friend_result) > 0) {
        $friend = mysqli_fetch_assoc($friend_result);

        // Voeg de vriend toe aan de vriendenlijst
        $insert_query = "INSERT INTO `friends` (`user_id`, `friend_id`) VALUES ('$user_id', '$friend_id')";
        if (mysqli_query($db, $insert_query)) {
            $friend_added = true;
        } else {
            $error_message = "Er is een fout opgetreden bij het toevoegen van de vriend.";
        }
    } else {
        $error_message = "Geen gebruiker gevonden met dit ID.";
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
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/elisa.css">
    <script src="../../js/currentPage.js" defer></script>
    <title>Friends</title>
</head>
<header>
    <div id="meta-data-page" style="display: none;">2</div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <h1>Voeg vrienden toe</h1>

    <?php if ($friend_added): ?>
        <p class="success">Vriend succesvol toegevoegd!</p>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <p class="error"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="friend_id" placeholder="Vrienden ID..." required>
        <button type="submit" name="search">Zoeken en toevoegen</button>
    </form>
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
