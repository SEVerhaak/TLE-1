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

<main>

    <?php if(isset($_SESSION['users_id'])){
    ?><h1>Welkom <?= $userName ?></h1>
    <?php }?>

    <section class="container">

        <a href = "../scanner">
            <div class="box color-3">
                <h2 class="color-white">Scan barcode</h2>
            </div>
        </a>

        <a href="../history/index.php">
            <div class="box color-6">
                <h2 class="color-white">Zoek product</h2>
            </div>
        </a>

    </section>

</main>

</body>
</html>
