<?php

class BasketController extends Controller
{
    public function __construct()
    {
        $basketView = new BasketView();
        parent::__construct($basketView, "BASKET");
    }

    public static function getProductIfQuantityGreaterThanZero($productArray, $productId, $options) {
        $resultingProduct = null;
        foreach ($productArray as $myProduct) {
            $myProductId = $myProduct->id;
            if ($myProductId != $productId) {
                continue;
            }
            $myOptions = $myProduct->options;
            $resultingProduct = $myProduct;
        }
        if (!isset($myOptions)) {
            return null;
        }
        $myOptionsArray = array();
        foreach ($myOptions as $myOption) {
            $myOptionValueId = $myOption->optionValueId;
            array_push($myOptionsArray, $myOptionValueId);
        }
        sort($options);
        sort($myOptionsArray);
        if ($options == $myOptionsArray) {
            return $resultingProduct;
        }
        return null;
    }

    public static function removeProduct(&$basket, $productId) {
        $productArray = $basket->products;
        $resultingProduct = self::searchProduct($productArray, $productId);
        if ($resultingProduct == null) {
            return $basket;
        }
        if(($key = array_search($resultingProduct, $productArray, true)) !== FALSE) {
            unset($productArray[$key]);
            $basket->products = $productArray;
            return $basket;
        }
    }

    public static function increaseProduct(&$basket, $productId) {
        $productArray = $basket->products;
        $resultingProduct = self::searchProduct($productArray, $productId);
        if ($resultingProduct == null) {
            return $basket;
        }
        $actualQuantity = $resultingProduct->quantity;
        if ($actualQuantity < 50) {
            $resultingProduct->quantity = $actualQuantity + 1;
        }
        return $basket;
    }

    public static function decreaseProduct(&$basket, $productId) {
        $productArray = $basket->products;
        $resultingProduct = self::searchProduct($productArray, $productId);
        if ($resultingProduct == null) {
            return $basket;
        }
        $actualQuantity = $resultingProduct->quantity;
        if ($actualQuantity == 1) {
            $basket = self::removeProduct($basket, $productId);
        }
        else if ($actualQuantity > 1) {
            $resultingProduct->quantity = $actualQuantity - 1;
        }
        return $basket;
    }

    private static function searchProduct(&$productArray, $productId) {
        $resultingProduct = null;
        foreach ($productArray as $myProduct) {
            $myProductId = $myProduct->id;
            if ($myProductId != $productId) {
                continue;
            }
            $resultingProduct = $myProduct;
        }
        return $resultingProduct;
    }

    public static function getBasket($personId)
    {
        $orderId = BasketController::getBasketOrderIdOfPerson($personId);
        if ($orderId == null) {
            return null;
        }
        $basket = new Basket();
        $basket->__set('id', $orderId);
        $basketProducts = BasketController::getBasketProductsByOrderId($orderId);
        $basket->__set('products', $basketProducts);
        return $basket;
    }

    public static function getBasketProductsByOrderId($orderId) {
        $query = 'select po.id, po.pname name, po.price, po.quantity, po.product_id realProductId from product_orders po where po.orders_id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $orderId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $products = array();
        while ($row = $result->fetch_assoc()) {
            $basketProduct = new BasketProduct();
            $basketProduct->setAll($row);
            $productOrderId = $row['id'];
            $productOptionIds = BasketController::getBasketProductOptionsByProductOrderId($productOrderId);
            $productOptions = array();
            foreach ($productOptionIds as $productOptionId) {
                $basketProductOption = new BasketProductOption();
                $basketProductOption->__set('optionValueId', $productOptionId);
                array_push($productOptions, $basketProductOption);
            }
            $basketProduct->__set('options', $productOptions);
            array_push($products, $basketProduct);
        }
        return $products;
    }

    public static function getBasketOrderIdOfPerson($personId)
    {
        $query = 'select o.id from orders o where o.person_id = ? and o.state = 0';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $personId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (!isset($row)) {
            return null;
        }
        return $row['id'];
    }

    public static function addToBasketOrIncrease($personId, $productId, $productQuantity, $optionArray)
    {
        $orderId = BasketController::getBasketOrderIdOfPerson($personId);
        if ($orderId == null) {
            $orderId = BasketController::createNewBasket($personId);
        }
        $query = 'select po.id, po.quantity from product_orders po where po.product_id = ? and po.orders_id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ii', $productId, $orderId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        while ($row = $result->fetch_assoc()) {
            $productOrderId = $row['id'];
            $storedQuantity = $row['quantity'];
            $storedOptionArray = BasketController::getBasketProductOptionsByProductOrderId($productOrderId);
            if (UtilityController::arraySameContent($storedOptionArray, $optionArray)) {
                BasketController::changeQuantityOfProductInBasket($storedQuantity, $productQuantity, $productOrderId);
                return;
            }
        }
        BasketController::addToBasket($productId, $orderId, $productQuantity, $optionArray);
    }

    public static function addToBasket($productId, $orderId, $productQuantity, $optionArray)
    {
        $query = 'select p.pname name, p.price from product p where p.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (isset($row)) {
            $productName = $row['name'];
            $productPrice = $row['price'];
            $productOrderId = OrderController::addNewProductOrder($productId, $orderId, $productQuantity, $productName, $productPrice);
            foreach ($optionArray as $optionId) {
                OrderController::addNewProductOrderValue($productOrderId, $optionId);
            }
        }
    }

    public static function getQuantityOfProductInBasket($productOrderId)
    {
        $query = 'select po.quantity from product_orders po where po.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productOrderId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (!isset($row)) {
            return null;
        }
        return $row['quantity'];
    }

    public static function changeQuantityOfProductInBasket($storedQuantity, $productQuantity, $productOrderId)
    {
        if ($storedQuantity == null) {
            $storedQuantity = BasketController::getQuantityOfProductInBasket($productOrderId);
        }
        $newQuantity = $storedQuantity + $productQuantity;
        if ($newQuantity == 0) {
            BasketController::removeProductFromBasket($productOrderId);
        }
        else if ($newQuantity > 0 && $newQuantity <= 50) {
            $query = 'update product_orders po set po.quantity = ? where po.id = ?';
            $stmt = DatabaseController::prepareWithErrorHandling($query);
            $success = $stmt->bind_param('ii', $newQuantity, $productOrderId);
            DatabaseController::checkBindingError($success);
            DatabaseController::executeWithErrorHandling($stmt);
            $stmt->close();
        }
    }

    public static function createNewBasket($personId)
    {
        $query = 'insert into orders (person_id) values (?)';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $personId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
        $orderId = DatabaseController::getLastInsertId();
        return $orderId;
    }

    public static function cleanBasket($personId)
    {
        $query = 'delete from orders where person_id = ? and state = 0';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        if (!$stmt) {
            return;
        }
        $success = $stmt->bind_param('i', $personId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function removeProductFromBasket($basketProductId)
    {
        $query = 'delete from product_orders where id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        if (!$stmt) {
            return;
        }
        $success = $stmt->bind_param('i', $basketProductId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    function getBasketProduct($basketProductId)
    {
        $query = 'select po.id, po.pname name, po.price, po.quantity, po.product_id realProductId from product_orders po where po.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $basketProductId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (isset($row)) {
            $basketProduct = new BasketProduct();
            $basketProduct->setAll($row);
            return $basketProduct;
        }
        return null;
    }

    public static function getBasketProductOptionsByProductOrderId($productOrderId)
    {
        $query = 'select poov.optionvalue_id optionValueId 
from product_orders_option_value poov
where poov.productorders_id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productOrderId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $productOptionIds = array();
        while ($row = $result->fetch_assoc()) {
            array_push($productOptionIds, $row['optionValueId']);
        }
        return $productOptionIds;
    }
}