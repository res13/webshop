<?php
if (isset($_POST['person'])) {
    $personId = $_POST['person']->__get('id');
    $basket = getBasket($personId);
    $_SESSION['person'] = $basket;
}
if (isset($_POST['toBasket']) && isset($_POST['options'])) {
    $productId = $_POST['toBasket'];
    $optionArray = $_POST['options'];
    if (isset($_POST['person'])) {
        $personId = $_POST['person']->__get('id');
        createOrAddToBasket($personId, $productId, $optionArray);
        $basket = getBasket($personId);
        $_SESSION['person'] = $basket;
    }
    else {
        $basketOptions = array();
        foreach ($optionArray as $optionId) {
            $basketOption = new BasketOption();
            // todo: fill basketOption
            array_push($basketOptions, $basketOption);
        }
        // todo: add basketOption to BasketProduct
        // todo: add basketProduct to Basket
    }
}
// todo: show basket
