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
    <link rel="stylesheet" href="../../css/elisa.css">
    <title>Homepage</title>
</head>
<body>
<?php include('../../includes/nav.php'); ?>
<main>

    <?php if(isset($_SESSION['users_id'])){
    ?><h1>Welkom <?= $userName ?></h1>
    <?php }?>

    <section class="container">

        <a href = "../scanner">
            <div class="box color-3">
                <h2 class="color-white">Scan barcode</h2>
                <img src="../images/barcode.png">
            </div>
        </a>

        <a href="../history/index.php">
            <div class="box color-6">
                <h2 class="color-white">Zoek product</h2>
                <img src="../images/search.png">
            </div>
        </a>

    </section>

</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
