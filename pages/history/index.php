<?php
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
if(isset($_SESSION['users_id'])){
    $user_id = $_SESSION['users_id'];
}else{
    header('Location: ../account/login.php?error=1');
}
$query = "SELECT barcode, product_name, favourite FROM `user_history` WHERE user_id = '$user_id';";
$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

if (mysqli_num_rows($result) > 0) {
    // Verwerk elke rij uit het resultaat
    while ($row = mysqli_fetch_assoc($result)) {
        // Voeg elke rij toe aan de array
        $data[] = $row;
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
    <link rel="stylesheet" href="../../css/isis.css">
    <script src="../../js/currentPage.js" defer></script>
    <script src="../../js/favoriteFilter.js" defer></script>
    <script src="../../js/clickableHistory.js" defer></script>

    <title>Geschiedenis</title>
</head>
<style>
    main{
        align-items: flex-start;
    }
</style>
<header>
    <div id="meta-data-page" style="display: none;">1</div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <h1 class="sub-header">Scan geschiedenis</h1>
    <input type="text" placeholder="Zoeken..." id = "search-bar" name="search" style = "opacity: 60%" class = "color-3" >
    <div class="fav-row">
        <input type="checkbox" id="show-favorites-only" style = "opacity: 60%" />
        <p class = "text-color-3" style = "opacity: 60%">Toon alleen favoriete producten</p>
    </div>

    <div class="solid"> </div>
    <div id="search-results">
        <?php if (!empty($data)) { ?>
            <!-- Als er resultaten zijn, toon ze -->
            <?php foreach ($data as $item) { ?>
                <section class="history
            <?php if($item['favourite'] === '1'){echo "color-box-history-favourite";}else{echo "color-box-history";} ?>">
                    <h3><?= $item['product_name'] ?> </h3>
                    <p class = "text-color-3" style = "opacity: 60%"> <?= "Barcode: " . $item['barcode'] ?> </p>

                    <a id = "link-history" class = "text-color-4" href="../product-info/index.php?ean=<?= $item['barcode'] ?>">Meer informatie</a>
                </section>
            <?php } ?>
        <?php } else { ?>
            <!-- Als er geen resultaten zijn, toon een bericht -->
            <p>Geen scan geschiedenis gevonden.</p>
        <?php } ?>
    </div>


</main>

<?php include('../../includes/footer.php'); ?>
</body>
</html>
