<?php
require ('head.php');
if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
    $person = authenticate($_POST['usernameOrEmail'], $_POST['password']);
    if ($person != null) {
        if ($person->resetpassword > 0) {
            redirect('resetPassword.php');
        }
        $_SESSION['person'] = $person;
        if (isset($_SESSION['basket'])) {
            $personId = $_SESSION['person']->__get('id');
            $basketProducts = $_SESSION['basket']->__get('products');
            foreach ($basketProducts as $basketProduct) {
                $productId = $basketProduct->__get('realProductId');
                $productQuantity = $basketProduct->__get('quantity');
                $productOptions = $basketProduct->__get('options');
                $optionArray = array();
                foreach ($productOptions as $productOption) {
                    $optionValueId = $productOption->__get('optionValueId');
                    array_push($optionArray, $optionValueId);
                }
                addToBasketOrIncrease($personId, $productId, $productQuantity, $optionArray);
                $_SESSION['basket'] = getBasket($personId, $_SESSION['lang']);
            }
        }
    }
    else {
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
<?php
if (isset($_SESSION['person'])) {
    echo getTextForLanguage("SUCCESSFUL_LOGIN");
}
else {
    ?>
    <form method="post">
        <?php echo getTextForLanguage("USERNAME")?> <?php echo getTextForLanguage("OR")?> <?php echo getTextForLanguage("EMAIL")?><br />
        <input type="text" name="usernameOrEmail" maxlength="50"><br />
        <?php echo getTextForLanguage("PASSWORD")?><br />
        <input type="password" name="password"><br />
        <a href="forgotPassword.php"><?php echo getTextForLanguage("FORGOT_PASSWORD")?></a><br />
        <input type="submit" value="<?php echo getTextForLanguage("LOGIN")?>">
    </form>
    <?php
}
?>
</div>
</body>
</html>
