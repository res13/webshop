<?php
require('head.php');
if (
    isset($_POST['deliveryFirstname'])
    && isset($_POST['deliveryLastname'])
    && isset($_POST['deliveryStreet'])
    && isset($_POST['deliveryHomenumber'])
    && isset($_POST['deliveryCity'])
    && isset($_POST['deliveryZip'])
    && isset($_POST['deliveryCountry'])) {
    $basketId = $_SESSION['basket']->id;
    $deliveryFirstname = validateInput($_POST['deliveryFirstname']);
    $deliveryLastname = validateInput($_POST['deliveryLastname']);
    $deliveryStreet = validateInput($_POST['deliveryStreet']);
    $deliveryHomenumber = validateInput($_POST['deliveryHomenumber']);
    $deliveryCity = validateInput($_POST['deliveryCity']);
    $deliveryZip = validateInput($_POST['deliveryZip']);
    $deliveryCountry = validateInput($_POST['deliveryCountry']);
    if (isset($_POST['billingDiffersCB'])) {
        $billingDiffersCB = validateInput($_POST['billingDiffersCB']);
        if ($billingDiffersCB === 'billingDiffers') {
            if (
                isset($_POST['billingFirstname'])
                && isset($_POST['billingLastname'])
                && isset($_POST['billingStreet'])
                && isset($_POST['billingHomenumber'])
                && isset($_POST['billingCity'])
                && isset($_POST['billingZip'])
                && isset($_POST['billingCountry'])
            ) {
                $billingFirstname = validateInput($_POST['billingFirstname']);
                $billingLastname = validateInput($_POST['billingLastname']);
                $billingStreet = validateInput($_POST['billingStreet']);
                $billingHomenumber = validateInput($_POST['billingHomenumber']);
                $billingCity = validateInput($_POST['billingCity']);
                $billingZip = validateInput($_POST['billingZip']);
                $billingCountry = validateInput($_POST['billingCountry']);
                orderBasketBillingDiffers($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry, $billingFirstname, $billingLastname, $billingStreet, $billingHomenumber, $billingCity, $billingZip, $billingCountry);
            } else {
                alert(getTextForLanguage("INPUT_MISSING"));
            }
        }
    } else {
        orderBasket($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry);
    }
    $subject = getTextForLanguage("ORDER") . " - " . $basketId;
    $messageToShop = "<html><body><p>" . echoArray($_POST) . "</p></body></html>";
    $messageToPerson = "<html><body><p>" . echoArray($_POST) . "</p></body></html>";
    $mailSent = sendMail($_SESSION['person']->email, $subject, $messageToShop) && sendMail(null, $subject, $messageToPerson);
    unset($_SESSION['basket']);
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("CHECKOUT")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo getTextForLanguage("CHECKOUT"); ?></h1>
    <?php
    if (isset($mailSent) && $mailSent == true) {
        echo "<p>" . getTextForLanguage("ORDER_SUBMITTED") . "</p>";
    } else {
        if (isset($_SESSION['person'])) {
            ?>
            <h3><?php echo getTextForLanguage("DELIVERY") ?></h3>
            <form method="post">
                <?php echo getTextForLanguage("FIRSTNAME") ?><br/>
                <input type="text" name="deliveryFirstname" maxlength="50"><br/>
                <?php echo getTextForLanguage("LASTNAME") ?><br/>
                <input type="text" name="deliveryLastname" maxlength="50"><br/>
                <?php echo getTextForLanguage("STREET") ?><br/>
                <input type="text" name="deliveryStreet" maxlength="100"><br/>
                <?php echo getTextForLanguage("HOMENUMBER") ?><br/>
                <input type="text" name="deliveryHomenumber" maxlength="20"><br/>
                <?php echo getTextForLanguage("CITY") ?><br/>
                <input type="text" name="deliveryCity" maxlength="100"><br/>
                <?php echo getTextForLanguage("ZIP") ?><br/>
                <input type="number" name="deliveryZip"><br/>
                <?php echo getTextForLanguage("COUNTRY") ?><br/>
                <select name="deliveryCountry">
                    <?php
                    $countries = getAllCountries();
                    foreach ($countries as $country) {
                        ?>
                        <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
                    }
                    ?>
                </select><br/><br/>
                <label><input type="checkbox" name="billingDiffersCB" value="billingDiffers"
                              onchange="billingDiffers(this);"><?php echo getTextForLanguage("BILLING_DIFFERS") ?>
                </label>
                <div id="billingDiv">
                    <h3><?php echo getTextForLanguage("BILLING") ?></h3>
                    <?php echo getTextForLanguage("FIRSTNAME") ?><br/>
                    <input type="text" name="billingFirstname" maxlength="50"><br/>
                    <?php echo getTextForLanguage("LASTNAME") ?><br/>
                    <input type="text" name="billingLastname" maxlength="50"><br/>
                    <?php echo getTextForLanguage("STREET") ?><br/>
                    <input type="text" name="billingStreet" maxlength="100"><br/>
                    <?php echo getTextForLanguage("HOMENUMBER") ?><br/>
                    <input type="text" name="billingHomenumber" maxlength="20"><br/>
                    <?php echo getTextForLanguage("CITY") ?><br/>
                    <input type="text" name="billingCity" maxlength="100"><br/>
                    <?php echo getTextForLanguage("ZIP") ?><br/>
                    <input type="number" name="billingZip"><br/>
                    <?php echo getTextForLanguage("COUNTRY") ?><br/>
                    <select name="billingCountry">
                        <?php
                        $countries = getAllCountries();
                        foreach ($countries as $country) {
                            ?>
                            <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
                        }
                        ?>
                    </select>
                </div>
                <br/>
                <input type="submit" value="<?php echo getTextForLanguage("BUY") ?>">
            </form>

            <?php
        } else {
            echo "<p>" . getTextForLanguage("MUST_BE_LOGGED_IN_TO_CHECKOUT") . "</p>";
            echo "<a href=\"login.php\">" . getTextForLanguage("LOGIN") . "</a> " . getTextForLanguage("OR") . " <a href=\"register.php\">" . getTextForLanguage("REGISTER") . "</a></br></br>";
        }
    }
    ?>
</div>
</body>
</html>


