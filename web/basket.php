<?php
require('head.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("BASKET")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo getTextForLanguage("BASKET"); ?></h1>
    <?php
    $show = (isset($_SESSION['basket']) && count($_SESSION['basket']->products) > 0);
    if ($show) {
        echo "<h2><a href='cleanBasket.php'>" . getTextForLanguage("CLEAN_BASKET") . '</a></h2>';
    }
    ?>

    <div class="row">
        <div class="col-75">
            <div class="container">
                <?php
                $show = (isset($_SESSION['basket']) && count($_SESSION['basket']->products) > 0);
                if ($show) {
                    $basket = $_SESSION['basket'];
                    $products = $basket->__get('products');
                    $remove = true;
                    include('util/orderTable.php');
                } else {
                    echo "<div class='innerContainer'><p>" . getTextForLanguage("BASKET_IS_EMPTY") . "</p></div>";
                }
                ?>
            </div>
        </div>
        <?php
        if ($show) { ?>
        <div class="col-25">
            <div class="container">
                <div class="innerContainer">
                    <?php include("checkout.php"); ?>
                </div>
            </div>

        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>