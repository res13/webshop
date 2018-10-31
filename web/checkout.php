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
                Order::orderBasketBillingDiffers($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry, $billingFirstname, $billingLastname, $billingStreet, $billingHomenumber, $billingCity, $billingZip, $billingCountry);
            } else {
                alert(getTextForLanguage("INPUT_MISSING"));
            }
        }
    } else {
        Order::orderBasket($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry);
    }
    $subject = getTextForLanguage("ORDER") . " - " . $basketId;
    $message = "<html><body>
    <h2>" . getTextForLanguage("DELIVERY") . "</h2>
    <p>" . getTextForLanguage("ORDER_ID") . "=" . $basketId . "</p>
    <p>" . getTextForLanguage("FIRSTNAME") . "=" . $deliveryFirstname . "</p>
    <p>" . getTextForLanguage("LASTNAME") . "=" . $deliveryLastname . "</p>
    <p>" . getTextForLanguage("STREET") . "=" . $deliveryStreet . "</p>
    <p>" . getTextForLanguage("HOMENUMBER") . "=" . $deliveryHomenumber . "</p>
    <p>" . getTextForLanguage("CITY") . "=" . $deliveryCity . "</p>
    <p>" . getTextForLanguage("ZIP") . "=" . $deliveryZip . "</p>
    <p>" . getTextForLanguage("COUNTRY") . "=" . $deliveryCountry . "</p>";
    if (isset($_POST['billingDiffersCB']) && validateInput($_POST['billingDiffersCB']) === 'billingDiffers') {
        $message .= "<h2>" . getTextForLanguage("BILLING") . "</h2>
    <p>" . getTextForLanguage("BILLING_DIFFERS") . "=" . getTextForLanguage("YES") . "</p>
    <p>" . getTextForLanguage("FIRSTNAME") . "=" . $billingFirstname . "</p>
    <p>" . getTextForLanguage("LASTNAME") . "=" . $billingLastname . "</p>
    <p>" . getTextForLanguage("STREET") . "=" . $billingStreet . "</p>
    <p>" . getTextForLanguage("HOMENUMBER") . "=" . $billingHomenumber . "</p>
    <p>" . getTextForLanguage("CITY") . "=" . $billingCity . "</p>
    <p>" . getTextForLanguage("ZIP") . "=" . $billingZip . "</p>
    <p>" . getTextForLanguage("COUNTRY") . "=" . $billingCountry . "</p>";
    }
    $message .= "</body></html>";
    $mailSent = sendMail($_SESSION['person']->email, $subject, $message) && sendMail(null, $subject, $message);
    unset($_SESSION['basket']);
}

?>
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
                <label><?php echo getTextForLanguage("FIRSTNAME") ?><br/><input type="text" name="deliveryFirstname"
                                                                           maxlength="50"></label><br/>
                <label><?php echo getTextForLanguage("LASTNAME") ?><br/><input type="text" name="deliveryLastname"
                                                                          maxlength="50"></label><br/>
                <label><?php echo getTextForLanguage("STREET") ?><br/><input type="text" name="deliveryStreet"
                                                                        maxlength="100"></label><br/>
                <label><?php echo getTextForLanguage("HOMENUMBER") ?><br/><input type="text" name="deliveryHomenumber"
                                                                            maxlength="20"></label><br/>
                <label><?php echo getTextForLanguage("CITY") ?><br/><input type="text" name="deliveryCity" maxlength="100">
                </label><br/>
                <label><?php echo getTextForLanguage("ZIP") ?><br/><input type="number" name="deliveryZip"></label><br/>
                <label><?php echo getTextForLanguage("COUNTRY") ?><br/><select class="selectLog" name="deliveryCountry">
                        <?php
                        $countries = Person::getAllCountries();
                        foreach ($countries as $country) {
                            ?>
                            <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
                        }
                        ?>
                    </select></label><br/><br/>
                <label><input type="checkbox" name="billingDiffersCB" value="billingDiffers"
                              onchange="billingDiffers(this);"><?php echo getTextForLanguage("BILLING_DIFFERS") ?>
                </label>
                <div id="billingDiv">
                    <h3><?php echo getTextForLanguage("BILLING") ?></h3>
                    <label><?php echo getTextForLanguage("FIRSTNAME") ?><br/><input type="text" name="billingFirstname"
                                                                               maxlength="50"></label><br/>
                    <label><?php echo getTextForLanguage("LASTNAME") ?><br/><input type="text" name="billingLastname"
                                                                              maxlength="50"></label><br/>
                    <label><?php echo getTextForLanguage("STREET") ?><br/><input type="text" name="billingStreet"
                                                                            maxlength="100"></label><br/>
                    <label><?php echo getTextForLanguage("HOMENUMBER") ?><br/><input type="text" name="billingHomenumber"
                                                                                maxlength="20"></label><br/>
                    <label><?php echo getTextForLanguage("CITY") ?><br/><input type="text" name="billingCity"
                                                                          maxlength="100"></label><br/>
                    <label><?php echo getTextForLanguage("ZIP") ?><br/><input type="number" name="billingZip"></label><br/>
                    <label><?php echo getTextForLanguage("COUNTRY") ?><br/><select class="selectLog" name="billingCountry">
                            <?php
                            $countries = Person::getAllCountries();
                            foreach ($countries as $country) {
                                ?>
                                <option
                                value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
                            }
                            ?>
                        </select></label>
                </div>
                <br/>
                <input class="btn" type="submit" value="<?php echo getTextForLanguage("BUY") ?>">
            </form>

            <?php
        } else {
            echo "<p>" . getTextForLanguage("MUST_BE_LOGGED_IN_TO_CHECKOUT") . "</p>";
            echo "<a href=\"login.php\">" . getTextForLanguage("LOGIN") . "</a> " . getTextForLanguage("OR") . " <a href=\"register.php\">" . getTextForLanguage("REGISTER") . "</a></br></br>";
        }
    }
    ?>
</div>


