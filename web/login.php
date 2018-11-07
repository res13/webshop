<?php
require('head.php');
if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
    $usernameOrEmail = validateInput($_POST['usernameOrEmail']);
    $password = validateInput($_POST['password']);
    $person = Person::authenticate($usernameOrEmail, $password);
    if ($person != null) {
        if ($person->__get('resetpassword') > 0) {
            redirect('resetPassword.php');
        }
        $_SESSION['person'] = $person;
        if (isset($_SESSION['basket'])) {
            $personId = $_SESSION['person']->__get('id');
            $basketProducts = $_SESSION['basket']->__get('products');
            foreach ($basketProducts as $basketProduct) {
                $productId = $basketProduct->realProductId;
                $productQuantity = $basketProduct->quantity;
                $productOptions = $basketProduct->options;
                $optionArray = array();
                foreach ($productOptions as $productOption) {
                    $optionValueId = $productOption->optionValueId;
                    array_push($optionArray, $optionValueId);
                }
                Basket::addToBasketOrIncrease($personId, $productId, $productQuantity, $optionArray);
                $_SESSION['basket'] = Basket::getBasket($personId);
            }
        }
    } else {
        alert(getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD"));
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("LOGIN")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo getTextForLanguage("LOGIN"); ?></h1>
    <div class="row">
        <div class="col-25"></div>
        <div class="col-25">
            <div class="container">
                <?php
                if (isset($_SESSION['person'])) {
                    echo getTextForLanguage("SUCCESSFUL_LOGIN");
                } else {
                    ?>
                    <form method="post"
                          onsubmit="return validateLogin()">
                        <label><?php echo getTextForLanguage("USERNAME") ?> <?php echo getTextForLanguage("OR") ?> <?php echo getTextForLanguage("EMAIL") ?>
                            <br/><input type="text" id="usernameOrEmail" name="usernameOrEmail" maxlength="255"
                                        minlength="4"
                                        onblur="validateForm('usernameOrEmail', [validateMoreThan3, validateLessThan256])"></label><br/>
                        <label><?php echo getTextForLanguage("PASSWORD") ?><br/><input type="password" id="password"
                                                                                       minlength="6" maxlength="255"
                                                                                       name="password"
                                                                                       onblur="validateForm('password', [validateMoreThan5, validateLessThan256])"></label><br/>
                        <a href="forgotPassword.php"><?php echo getTextForLanguage("FORGOT_PASSWORD") ?></a><br/>
                        <input class="btn" type="submit" value="<?php echo getTextForLanguage("LOGIN") ?>">
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-25"></div>
    </div>
</div>
</body>
</html>
