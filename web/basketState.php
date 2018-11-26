<?php
require_once('util/i18n.php');
if (isset($_SESSION['person']) && !isset($_SESSION['basket'])) {
    $personId = $_SESSION['person']->__get('id');
    $basket = Basket::getBasket($personId);
    $_SESSION['basket'] = $basket;
}
if (isset($_GET['removeFromBasket']) && isset($_SESSION['basket'])) {
    $productIdToRemove = $_GET['removeFromBasket'];
    if (isset($_SESSION['person'])) {
        $personId = $_SESSION['person']->__get('id');
        Basket::removeProductFromBasket($productIdToRemove);
        $basket = Basket::getBasket($personId);
    }
    else {
        $basket = $_SESSION['basket'];
        $basket->removeProduct($productIdToRemove);
    }
    $_SESSION['basket'] = $basket;
}
if (isset($_GET['increaseQuantity']) && isset($_SESSION['basket'])) {
    $productIdToIncrease = $_GET['increaseQuantity'];
    if (isset($_SESSION['person'])) {
        $personId = $_SESSION['person']->__get('id');
        Basket::changeQuantityOfProductInBasket(null, 1, $productIdToIncrease);
        $basket = Basket::getBasket($personId);
    }
    else {
        $basket = $_SESSION['basket'];
        $basket->increaseProduct($productIdToIncrease);
    }
    $_SESSION['basket'] = $basket;
}
if (isset($_GET['decreaseQuantity']) && isset($_SESSION['basket'])) {
    $productIdToDecrease = $_GET['decreaseQuantity'];
    if (isset($_SESSION['person'])) {
        $personId = $_SESSION['person']->__get('id');
        Basket::changeQuantityOfProductInBasket(null, -1, $productIdToDecrease);
        $basket = Basket::getBasket($personId);
    }
    else {
        $basket = $_SESSION['basket'];
        $basket->decreaseProduct($productIdToDecrease);
    }
    $_SESSION['basket'] = $basket;
}
if (isset($_POST['toBasket']) && isset($_POST['options'])) {
    $productId = validateInput($_POST['toBasket']);
    $productQuantity = validateInput($_POST['quantity']);
    $productName = validateInput($_POST['productName']);
    $productPrice = validateInput($_POST['productPrice']);
    $realProductId = validateInput($_POST['realProductId']);
    $optionArray = validateInput($_POST['options']);
    if (isset($_SESSION['person'])) {
        $personId = $_SESSION['person']->__get('id');
        Basket::addToBasketOrIncrease($personId, $productId, $productQuantity, $optionArray);
        $basket = Basket::getBasket($personId);
    }
    else {
        $basketOptions = array();
        foreach ($optionArray as $optionId) {
            $basketProductOption = new BasketProductOption();
            $basketProductOption->__set('optionValueId', $optionId);
            array_push($basketOptions, $basketProductOption);
        }
        $basketProduct = new BasketProduct();
        $basketProduct->__set('id', $productId);
        $basketProduct->__set('quantity', $productQuantity);
        $basketProduct->__set('name', $productName);
        $basketProduct->__set('price', $productPrice);
        $basketProduct->__set('realProductId', $realProductId);
        $basketProduct->__set('options', $basketOptions);
        if (isset($_SESSION['basket'])) {
            $basket = $_SESSION['basket'];
            $storedProduct = $basket->getProductIfQuantityGreaterThanZero($productId, $optionArray);
            if ($storedProduct != null) {
                $storedQuantity = $storedProduct->quantity;
                if ($storedQuantity > 0) {
                    $storedProduct->quantity = $storedQuantity + $productQuantity;
                }
            }
            else {
                $basketProducts = $basket->__get('products');
                array_push($basketProducts, $basketProduct);
                $basket->__set('products', $basketProducts);
            }
        }
        else {
            $basket = new Basket();
            $basketProducts = array();
            array_push($basketProducts, $basketProduct);
            $basket->__set('products', $basketProducts);
        }
    }
    $_SESSION['basket'] = $basket;
}
if (isset($_SESSION['basket'])) {
    $basket = $_SESSION['basket'];
    $basketProducts = $basket->__get('products');
    $productCount = count($basketProducts);
}
else {
    $productCount = 0;
}
?>
<div class="icon-wrapper">
    <a href="basket.php" class="button"><i class="faPad fas fa-shopping-cart fa-3x"></i></a>
    <span class="badge"><?php echo $productCount ?></span>
</div>
