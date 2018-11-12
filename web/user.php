<?php
require('head.php');
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <?php echo getHTMLHead(getTextForLanguage("USER")); ?>
    </head>
    <body>
    <?php require('body.php'); ?>
    <div class="main">
        <h1><?php echo getTextForLanguage("USER"); ?></h1>
        <?php
        // todo: change user attributes
        echo $person; ?>
        <?php echo "<br/><a href=\"myOrders.php\">" . getTextForLanguage("MY_ORDERS") . "</a>" ?>
    </div>
    <div class="container">
        <div class="innerContainer">
            <form method="post" onsubmit="return validateCheckout();">
                <label><?php echo getTextForLanguage("FIRSTNAME") ?><br/><input type="text" name="deliveryFirstname"
                                                                                id="deliveryFirstname"
                                                                                onblur="validateForm('deliveryFirstname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                                minlength="1"
                                                                                maxlength="50"
                                                                                value="<?php echo $person->__get("firstname") ?>"></label><br/>
                <label><?php echo getTextForLanguage("LASTNAME") ?><br/><input type="text" name="deliveryLastname"
                                                                               id="deliveryLastname"
                                                                               onblur="validateForm('deliveryLastname', [validateNotEmpty, validateLessThan51, validateOnlyText])"
                                                                               minlength="1"
                                                                               maxlength="50"
                                                                               value="<?php echo $person->__get("lastname") ?>"></label><br/>
                <label><?php echo getTextForLanguage("STREET") ?><br/><input type="text" name="deliveryStreet"
                                                                             id="deliveryStreet"
                                                                             onblur="validateForm('deliveryStreet', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                             minlength="1" maxlength="100"
                                                                             value="<?php echo $person->__get("street") ?>"></label><br/>
                <label><?php echo getTextForLanguage("HOMENUMBER") ?><br/><input type="text" name="deliveryHomenumber"
                                                                                 id="deliveryHomenumber"
                                                                                 onblur="validateForm('deliveryHomenumber', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                                 minlength="1"
                                                                                 maxlength="20"
                                                                                 value="<?php echo $person->__get("homenumber") ?>"></label><br/>
                <label><?php echo getTextForLanguage("CITY") ?><br/><input type="text" name="deliveryCity"
                                                                           id="deliveryCity"
                                                                           onblur="validateForm('deliveryCity', [validateNotEmpty, validateOnlyTextAndNumbers])"
                                                                           minlength="1"
                                                                           maxlength="100"
                value="<?php echo $person->__get("city") ?>"></label><br/>
                <label><?php echo getTextForLanguage("ZIP") ?><br/><input type="number" name="deliveryZip"
                                                                          id="deliveryZip"
                                                                          onblur="validateForm('deliveryZip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21])"
                                                                          minlength="1" maxlength="20"
                                                                          value="<?php echo $person->__get("zip") ?>"></label><br/>

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

                </div>
                <br/>
                <input class="btn" type="submit" value="<?php echo getTextForLanguage("SAVE") ?>">
            </form>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    redirect("login.php");
}
