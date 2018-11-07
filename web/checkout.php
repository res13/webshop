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
            <form method="post" onsubmit="return validateCheckout();">
                <label><?php echo getTextForLanguage("FIRSTNAME") ?><br/><input type="text" name="deliveryFirstname"
                                                                                id="deliveryFirstname"
                                                                                onblur="validateForm('deliveryFirstname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                                minlength="1"
                                                                                maxlength="50"></label><br/>
                <label><?php echo getTextForLanguage("LASTNAME") ?><br/><input type="text" name="deliveryLastname"
                                                                               id="deliveryLastname"
                                                                               onblur="validateForm('deliveryLastname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                               minlength="1"
                                                                               maxlength="50"></label><br/>
                <label><?php echo getTextForLanguage("STREET") ?><br/><input type="text" name="deliveryStreet"
                                                                             id="deliveryStreet"
                                                                             onblur="validateForm('deliveryStreet', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                             minlength="1" maxlength="100"></label><br/>
                <label><?php echo getTextForLanguage("HOMENUMBER") ?><br/><input type="text" name="deliveryHomenumber"
                                                                                 id="deliveryHomenumber"
                                                                                 onblur="validateForm('deliveryHomenumber', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                 minlength="1"
                                                                                 maxlength="20"></label><br/>
                <label><?php echo getTextForLanguage("CITY") ?><br/><input type="text" name="deliveryCity"
                                                                           id="deliveryCity"
                                                                           onblur="validateForm('deliveryCity', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                           minlength="1"
                                                                           maxlength="100">
                </label><br/>
                <label><?php echo getTextForLanguage("ZIP") ?><br/><input type="number" name="deliveryZip"
                                                                          id="deliveryZip"
                                                                          onblur="validateForm('deliveryZip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21])"
                                                                          minlength="1" maxlength="20"></label><br/>
                <label><?php echo getTextForLanguage("COUNTRY") ?><br/><select class="selectLog" name="deliveryCountry"
                                                                               id="deliveryCountry"
                                                                               onblur="validateForm('deliveryCountry', [validateNotEmpty, validateCountry])"
                                                                               name="country">
                        <?php
                        $countries = Person::getAllCountries();
                        foreach ($countries as $country) {
                            ?>
                            <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
                        }
                        ?>
                    </select></label><br/><br/>
                <label><input type="checkbox" name="billingDiffersCB" id="billingDiffersCB" value="billingDiffers"
                              onchange="billingDiffers(this);"><?php echo getTextForLanguage("BILLING_DIFFERS") ?>
                </label>
                <div id="billingDiv">
                    <h3><?php echo getTextForLanguage("BILLING") ?></h3>
                    <label><?php echo getTextForLanguage("FIRSTNAME") ?><br/><input type="text" name="billingFirstname"
                                                                                    id="billingFirstname"
                                                                                    onblur="validateForm('billingFirstname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                                    minlength="1"
                                                                                    maxlength="50"></label><br/>
                    <label><?php echo getTextForLanguage("LASTNAME") ?><br/><input type="text" name="billingLastname"
                                                                                   id="billingLastname"
                                                                                   onblur="validateForm('billingLastname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                                   minlength="1"
                                                                                   maxlength="50"></label><br/>
                    <label><?php echo getTextForLanguage("STREET") ?><br/><input type="text" name="billingStreet"
                                                                                 id="billingStreet"
                                                                                 onblur="validateForm('billingStreet', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                 minlength="1" maxlength="100"></label><br/>
                    <label><?php echo getTextForLanguage("HOMENUMBER") ?><br/><input type="text" name="billingHomenumber"
                                                                                     id="billingHomenumber"
                                                                                     onblur="validateForm('billingHomenumber', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                     minlength="1"
                                                                                     maxlength="20"></label><br/>
                    <label><?php echo getTextForLanguage("CITY") ?><br/><input type="text" name="billingCity"
                                                                               id="billingCity"
                                                                               onblur="validateForm('billingCity', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                               minlength="1"
                                                                               maxlength="100">
                    </label><br/>
                    <label><?php echo getTextForLanguage("ZIP") ?><br/><input type="number" name="billingZip"
                                                                              id="billingZip"
                                                                              onblur="validateForm('billingZip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21])"
                                                                              minlength="1" maxlength="20"></label><br/>
                    <label><?php echo getTextForLanguage("COUNTRY") ?><br/><select class="selectLog" name="billingCountry"
                                                                                   id="billingCountry"
                                                                                   onblur="validateForm('billingCountry', [validateNotEmpty, validateCountry])"
                                                                                   name="country">
                            <?php
                            $countries = Person::getAllCountries();
                            foreach ($countries as $country) {
                                ?>
                                <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option><?php
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


