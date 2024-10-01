<?php
session_start();
require_once "../../api/isLocal.php";

$dbLocation = '';

if (isLocalhost()) {
    $dbLocation = '../../api/dblocal.php';
} else {
    $dbLocation = '../../api/db.php';
}

require_once $dbLocation;

/** @var mysqli $db */


// Check if the user is logged in
if (!isset($_SESSION['users_id'])) {
    header('Location: ../account/login.php?error=1');
    exit();
}

// Fetch the user's data from the database
$user_id = $_SESSION['users_id'];
$query = "SELECT `email`, `f_name`, `l_name`, `phone`, `score`  FROM `users` WHERE `id` = '$user_id'";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User data not found.";
    exit();
}

// Fetch the user's friends from the database
$friendsQuery = "SELECT u.id, u.f_name, u.l_name, u.score, u.photo
                 FROM friends f 
                 JOIN users u ON f.friend_id = u.id 
                 WHERE f.user_id = '$user_id'";
$friendsResult = mysqli_query($db, $friendsQuery);

// Check if the user has friends
$friends = [];
if ($friendsResult && mysqli_num_rows($friendsResult) > 0) {
    while ($row = mysqli_fetch_assoc($friendsResult)) {
        $friends[] = $row;
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
    <link rel="stylesheet" href="../../css/bas.css">

    <script src="../../js/currentPage.js" defer></script>
    <title>Friends</title>
</head>
<header>
    <div id="meta-data-page" style="display: none;">2</div>
</header>
<style>
    .first{
        margin-bottom: 5vh;
    }

    .friend-box {
        min-width: 80vw;
        border-radius: 1.5rem;
        padding: 5vw;
        margin-top: 1vh;
        margin-bottom: 1vh;
    }

    .friend-flex-box {
        display: flex;
        flex-direction: row;
    }

    .friend-pic {
        min-width: 20vw;
        max-height: 20vw;
        max-width: 20vw;
        min-height: 20vw;
        border-radius: 100rem;
        margin: 0;
    }

    .add-friends-button {
        position: fixed;
    }

</style>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <h1 class="first">Jouw Vrienden:</h1>
    <?php if (count($friends) > 0): ?>
        <?php foreach ($friends as $friend): ?>
            <div class="friend-box color-7">
                <div class="friend-flex-box">
                    <?php
                    // Check if there is a photo in the database
                    if (!empty($friend['photo'])) {
                        // Convert the binary data to base64
                        $imageData = base64_encode($friend['photo']);
                        // Create the base64-encoded image string
                        $src = 'data:image/jpeg;base64,' . $imageData;
                    } else {
                        // Use a placeholder image if there is no photo in the database
                        $src = '../../images/placeholder.webp';
                    }
                    ?>
                    <img class="friend-pic" src="<?= $src ?>" alt="Friend's photo">
                    <ul>
                        <li>
                            <?= htmlspecialchars($friend['f_name']) . ' ' . htmlspecialchars($friend['l_name']) ?>
                        </li>
                        <li>
                            <?= "Score: " . htmlspecialchars($friend['score']) ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <p>Je hebt nog geen vrienden toegevoegd.</p>
    <?php endif; ?>
    <button class="save-info eco-color-grey">
        <h3 id="button-text" class="color-white"> Voeg vrienden toe! </h3>
    </button>
</main>

<?php include('../../includes/footer.php'); ?>
</body>
<script>
    let addFriendsButton = document.getElementsByClassName('save-info')[0];
    addFriendsButton.addEventListener('click', function () {
        window.location.href = "add.php"
    })
</script>
</html>
