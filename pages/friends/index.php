<?php
session_start();

/** @var mysqli $db */
require_once "../../api/dblocal.php";

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

// Fetch the user's friends from the database
$friendsQuery = "SELECT u.id, u.f_name, u.l_name
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
    <script src="../../js/currentPage.js" defer></script>
    <title>Friends</title>
</head>
<header>
    <div id="meta-data-page" style="display: none;">2</div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <h1>Vrienden</h1>
    <a href='../../pages/friends/add.php'>Voeg vrienden toe</a>

    <h2>Jouw Vrienden:</h2>
    <?php if (count($friends) > 0): ?>
        <ul>
            <?php foreach ($friends as $friend): ?>
                <li>
                    <?= htmlspecialchars($friend['f_name']) . ' ' . htmlspecialchars($friend['l_name']) ?> punten: (0)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Je hebt nog geen vrienden toegevoegd.</p>
    <?php endif; ?>
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
