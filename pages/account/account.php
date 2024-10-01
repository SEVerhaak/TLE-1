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

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Retrieve the uploaded file
    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    // Update the image in the database (store as BLOB)
    $sql = "UPDATE `users` SET `photo` = '$imgContent' WHERE `id` = '$user_id'";

    if ($db->query($sql) === TRUE) {
        echo "Afbeelding is succesvol geüpload en opgeslagen!";
    } else {
        echo "Fout bij het opslaan van het bestand in de database: " . $db->error;
    }
}

function getImageMimeType($imageData) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_buffer($finfo, $imageData);
    finfo_close($finfo);
    return $mimeType;
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
    <script src="../../js/uploadFoto.js" defer></script>
    <title>EcoJourney Account</title>
</head>
<header>
    <div id="meta-data-page" style="display: none;">2</div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <div class="account-details">
        <?php
        if (!empty($user['photo'])) {
            echo '<img class="image-pfp" src="data:' . getImageMimeType($user['photo']) . ';base64,' . base64_encode($user['photo']) . '" alt="Profielfoto">';
        } else {
            echo '<img class="image-pfp" src="../../images/stockpfp.jpg" alt="Standaard Profielfoto">';
        }?>
        <h1 class = "text-color-1"> <?= htmlspecialchars($user['f_name']) . ' ' . htmlspecialchars($user['l_name']); ?></h1>


        <!-- Toon je ID -->
        <h class = "text-color-1">ID: <?= $_SESSION["users_id"] ?></h>
        <h3><?= htmlspecialchars($user['score']) ?> points</h3>
        <form id="upload-form" action="account.php" method="post" enctype="multipart/form-data">
            <label for="file-upload" class="custom-file-upload color-3">Upload foto</label>
            <input type="file" name="image" id="file-upload" style="display: none;" accept="image/*">
        </form>
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
    <div style="
    width: 85vw;
">
        <a href="../friends/"><button class="logout-button color-3" style="width: 100%;">Friends</button></a>
        <a href="logout.php"><button class="logout-button color-red" style="width: 100%;" >Logout</button></a>
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
