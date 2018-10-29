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

    <div class="row">
        <div class="col-75">
            <div class="container">
                <?php
                if (isset($_SESSION['basket']) && count($_SESSION['basket']->products) > 0) {
                    $basket = $_SESSION['basket'];
                    $products = $basket->__get('products');
                    $remove = true;
                    include('util/orderTable.php');
                    echo "<a href=\"cleanBasket.php\">" . getTextForLanguage("CLEAN_BASKET") . "</a><br/><br/>";
                    echo "<a href=\"checkout.php\">" . getTextForLanguage("CHECKOUT") . "</a>";
                } else {
                    echo "<p>" . getTextForLanguage("BASKET_IS_EMPTY") . "</p>";
                }
                ?>
            </div>
        </div>
        <div class="col-25">
            <div class="container">
                <form action="/action_page.php">

                    <div class="row">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="john@example.com">
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="New York">

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="NY">
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="10001">
                                </div>
                            </div>
                        </div>
                    </div>
                    <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                    </label>
                    <input type="submit" value="Continue to checkout" class="btn">
                </form>
            </div>

        </div>
    </div>
</div>
</body>
</html>