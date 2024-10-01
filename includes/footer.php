<?php
$isLoggedIn = isset($_SESSION['users_id']);
?>
<footer>
    <a class="footer-box" href="../../pages/homepage/index.php">
        <img class="footer-img" src="../../images/icons/home.svg">
        <p>Home</p>
    </a>
    <a class="footer-box" href="../../pages/history/index.php">
        <img class="footer-img" src="../../images/icons/receipt.svg">
        <p>Gescand</p>
    </a>
    <a class="footer-box" href="<?php echo isset($_SESSION['users_id']) ? '../../pages/account/account.php' : '../../pages/account/login.php'; ?>">
        <img class="footer-img" src="../../images/icons/user.svg">
        <p>Account</p>
    </a>
</footer>
