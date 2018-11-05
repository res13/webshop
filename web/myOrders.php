<?php
require('head.php');
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    $orderList = Order::getOrders($person->id);
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <?php echo getHTMLHead(getTextForLanguage("MY_ORDERS")); ?>
    </head>
    <body>
    <?php require('body.php'); ?>
    <div class="main">
        <h1><?php echo getTextForLanguage("MY_ORDERS"); ?></h1>

        <div class="accordion vertical">
            <ul>
                <?php foreach ($orderList as $order) { ?>
                    <li>
                        <input type="checkbox" id="<?php echo htmlentities($order->id) ?>" name="checkbox-accordion"/>
                        <label for="<?php echo htmlentities($order->id) ?>">
                            #<?php echo htmlentities($order->id) ?></td> -
                            <?php echo htmlentities($order->purchasedate) ?> -
                            <?php echo htmlentities($order->paymentmethod) ?> -
                            <?php echo htmlentities($order->state) ?>
                        </label>
                        <div class="content">
                            <?php
                            $products = $order->products;
                            $remove = false;
                            include('util/orderTable.php');
                            ?>
                        </div>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    redirect("login.php");
}
