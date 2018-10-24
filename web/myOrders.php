<?php
require('head.php');
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    $orderList = getOrders($person->id);
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
        <table>
            <thead>
            <tr>
                <th><?php echo getTextForLanguage("ORDER_ID"); ?></th>
                <th><?php echo getTextForLanguage("PURCHASEDATE"); ?></th>
                <th><?php echo getTextForLanguage("PAYMENTMETHOD"); ?></th>
                <th><?php echo getTextForLanguage("STATE"); ?></th>
                <th><?php echo getTextForLanguage("PRODUCTS"); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orderList as $order) { ?>
                <tr>
                    <td><?php echo htmlentities($order->__get('id')) ?></td>
                    <td><?php echo htmlentities($order->__get('purchasedate')) ?></td>
                    <td><?php echo htmlentities($order->__get('paymentmethod')) ?></td>
                    <td><?php echo htmlentities($order->__get('state')) ?></td>
                    <td>
                        <?php
                        $products = $order->__get('products');
                        $remove = false;
                        include('util/orderTable.php');
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>
    <?php
} else {
    redirect("login.php");
}
