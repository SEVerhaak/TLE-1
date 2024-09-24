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
    <title>Account Preview</title>
</head>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <h1>Account Overview</h1>
    <div class="account-details">
        <p><img src="../../images/stockpfp.jpg"></p>  nog aanpassen naar persoonlijke pfp!!!
        <p><strong>First Name:</strong> <?= htmlspecialchars($user['f_name']); ?></p>
        <p><strong>Last Name:</strong> <?= htmlspecialchars($user['l_name']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone Number:</strong> <?= htmlspecialchars($user['phone']); ?></p>
    </div>
    <a href="logout.php" class="logout-button">Log out</a>
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
