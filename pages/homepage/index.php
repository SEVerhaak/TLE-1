<?php
session_start();
if(isset($_SESSION['users_id'])){
    $userName = $_SESSION['user_name'];
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
    <title>Homepage</title>
</head>
<body>
<nav>
    <img src="../../images/menu.png" alt="Menu">
    <img src="../../images/settings.png" alt="Settings">
</nav>

<main>
    <div class="stripe"> </div>

    <?php if(isset($_SESSION['users_id'])){
    ?><h1>Welkom <?= $userName ?></h1>
    <?php }?>
    <img src="../../images/EcoJourneyL2.png" alt="Logo">
    <div class="short-stripe"> </div>
    <a href = "../scanner">
        <button>Scan hier!</button>
    </a>
    <a href="../history/index.php">
        <button>Scan Geschiedenis</button>
    </a>
    <?php if(isset($_SESSION['users_id'])){
        ?><a href="../account/logout.php">
            <button>Uitloggen</button>
        </a>
    <?php }else{ ?>
        <a href="../account/login.php">
            <button>Inloggen</button>
        </a>
    <?php }?>
</main>

<footer>
    <img src="../../images/triangular-arrows-sign-for-recycle.png" alt="Recycle"
</footer>
</body>
</html>
