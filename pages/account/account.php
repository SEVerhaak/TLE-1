<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

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

// Check if the user is logged in
if (!isset($_SESSION['users_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch the user's data from the database
$user_id = $_SESSION['users_id'];
$query = "SELECT `email`, `f_name`, `l_name`, `phone`, `photo`, `score` FROM `users` WHERE `id` = '$user_id'";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User data not found.";
    exit();
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
    <link rel="stylesheet" href="../../css/bas.css">
    <script src="../../js/currentPage.js" defer></script>
    <title>Account Preview</title>
</head>
<header>
    <div id="meta-data-page" style="display: none;">2</div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <div class="account-details">
        <?php
        if ($user['photo'] != "" && file_exists($dbLocation . $user['photo'])) {
            echo '<img class="image-pfp" src="../../images/uploads/' . htmlspecialchars($user['photo']) . '" alt="Profielfoto">';
        } else { ?>
            <img class = "image-pfp" src="../../images/stockpfp.jpg">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label>Select Image File:</label>
                <input type="file" name="image">
                <input type="submit" name="submit" value="Upload">
            </form>
        <?php } ?>
        <h1 class = "text-color-1"> <?= htmlspecialchars($user['f_name']) . ' ' . htmlspecialchars($user['l_name']); ?></h1>
        <h3><?= htmlspecialchars($user['score']) ?> points</h3>
        <button class="accordion">Emails<img class = "accordion-image" src="../../images/chefron.svg" /></button>
        <div class="panel">
            <ul>
                <p><?= htmlspecialchars($user['email']); ?></p>
            </ul>
        </div>
        <button class="accordion">Telefoonnummer<img class = "accordion-image" src="../../images/chefron.svg" /></button>
        <div class="panel">
            <ul>
                <p><?= htmlspecialchars($user['phone']); ?></p>
            </ul>
        </div>
    </div>
    <div>
        <a href="logout.php"><button class="logout-button color-3" >Logout</button></a>
    </div>
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
<script>
    let accordion
    accordionInit()

    function accordionInit(){
        accordion = document.getElementsByClassName("accordion");
        // voor de dropdown accordion menu's
        for (let i = 0; i < accordion.length; i++) {
            accordion[i].addEventListener("click", function () {
                console.log(this)
                let panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                    this.classList.remove("active");
                } else {
                    panel.style.display = "block";
                    this.classList.add("active");
                }
            });
        }
    }
</script>
