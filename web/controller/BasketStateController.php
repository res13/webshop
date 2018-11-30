<?php

class BasketStateController
{

    private $view;

    public function __construct()
    {
        $this->view = new BasketStateView();
    }

    public function getContent()
    {
        if (isset($_SESSION['person']) && !isset($_SESSION['basket'])) {
            $personId = $_SESSION['person']->__get('id');
            $basket = BasketController::getBasket($personId);
            $_SESSION['basket'] = $basket;
        }
        if (isset($_GET['cleanBasket']) && isset($_SESSION['basket'])) {
            if (isset($_SESSION['person'])) {
                BasketController::cleanBasket($_SESSION['person']->__get('id'));
            }
            unset($_SESSION['basket']);
        }
        if (isset($_GET['removeFromBasket']) && isset($_SESSION['basket'])) {
            $productIdToRemove = $_GET['removeFromBasket'];
            if (isset($_SESSION['person'])) {
                $personId = $_SESSION['person']->__get('id');
                BasketController::removeProductFromBasket($productIdToRemove);
                $basket = BasketController::getBasket($personId);
            } else {
                $basket = $_SESSION['basket'];
                $basket->removeProduct($productIdToRemove);
            }
            $_SESSION['basket'] = $basket;
        }
        if (isset($_GET['increaseQuantity']) && isset($_SESSION['basket'])) {
            $productIdToIncrease = $_GET['increaseQuantity'];
            if (isset($_SESSION['person'])) {
                $personId = $_SESSION['person']->__get('id');
                BasketController::changeQuantityOfProductInBasket(null, 1, $productIdToIncrease);
                $basket = BasketController::getBasket($personId);
            } else {
                $basket = $_SESSION['basket'];
                $basket->increaseProduct($productIdToIncrease);
            }
            $_SESSION['basket'] = $basket;
        }
        if (isset($_GET['decreaseQuantity']) && isset($_SESSION['basket'])) {
            $productIdToDecrease = $_GET['decreaseQuantity'];
            if (isset($_SESSION['person'])) {
                $personId = $_SESSION['person']->__get('id');
                BasketController::changeQuantityOfProductInBasket(null, -1, $productIdToDecrease);
                $basket = BasketController::getBasket($personId);
            } else {
                $basket = $_SESSION['basket'];
                $basket->decreaseProduct($productIdToDecrease);
            }
            $_SESSION['basket'] = $basket;
        }
        if (isset($_POST['toBasket']) && isset($_POST['options'])) {
            $productId = UtilityController::validateInput($_POST['toBasket']);
            $productQuantity = UtilityController::validateInput($_POST['quantity']);
            $productName = UtilityController::validateInput($_POST['productName']);
            $productPrice = UtilityController::validateInput($_POST['productPrice']);
            $realProductId = UtilityController::validateInput($_POST['realProductId']);
            $optionArray = UtilityController::validateInput($_POST['options']);
            if (isset($_SESSION['person'])) {
                $personId = $_SESSION['person']->__get('id');
                BasketController::addToBasketOrIncrease($personId, $productId, $productQuantity, $optionArray);
                $basket = BasketController::getBasket($personId);
            } else {
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
                    } else {
                        $basketProducts = $basket->__get('products');
                        array_push($basketProducts, $basketProduct);
                        $basket->__set('products', $basketProducts);
                    }
                } else {
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
        } else {
            $productCount = 0;
        }
        return $this->view->renderWithCounter($this->languageController, $productCount);
    }

}