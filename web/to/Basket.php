<?php

class Basket extends TransferObject
{
    private $data = array(
        'id' => '',
        'products' => '',
    );

    public function setAll($dataArray)
    {
        parent::setArray($this->data, $dataArray);
    }

    public function __get($name)
    {
        return parent::get($this->data, $name);
    }

    public function __set($name, $value)
    {
        parent::set($this->data, $name, $value);
    }

    public function __toString()
    {
        return parent::toString($this->data);
    }

    public function getProductIfQuantityGreaterThanZero($productId, $options) {
        $productArray = $this->__get('products');
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

    public function removeProduct($productId) {
        $resultingProduct = null;
        $productArray = $this->__get('products');
        foreach ($productArray as $myProduct) {
            $myProductId = $myProduct->id;
            if ($myProductId != $productId) {
                continue;
            }
            $resultingProduct = $myProduct;
        }
        if(($key = array_search($resultingProduct, $productArray, true)) !== FALSE) {
            unset($productArray[$key]);
        }
        $this->__set('products', $productArray);
    }

    public static function getBasket($personId)
    {
        $orderId = Basket::getBasketOrderIdOfPerson($personId);
        if ($orderId == null) {
            return null;
        }
        $basket = new Basket();
        $basket->__set('id', $orderId);
        $basketProducts = Basket::getBasketProductsByOrderId($orderId);
        $basket->__set('products', $basketProducts);
        return $basket;
    }

    public static function getBasketProductsByOrderId($orderId) {
        $query = 'select po.id, po.pname name, po.price, po.quantity, po.product_id realProductId from webshop.product_orders po where po.orders_id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $orderId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $products = array();
        while ($row = $result->fetch_assoc()) {
            $basketProduct = new BasketProduct();
            $basketProduct->setAll($row);
            $productOrderId = $row['id'];
            $productOptionIds = BasketProductOption::getBasketProductOptionsByProductOrderId($productOrderId);
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
        $query = 'select o.id from webshop.orders o where o.person_id = ? and o.state = 0';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $personId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
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
        $orderId = Basket::getBasketOrderIdOfPerson($personId);
        if ($orderId == null) {
            $orderId = Basket::createNewBasket($personId);
        }
        $query = 'select po.id, po.quantity from webshop.product_orders po where po.product_id = ? and po.orders_id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ii', $productId, $orderId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        while ($row = $result->fetch_assoc()) {
            $productOrderId = $row['id'];
            $storedQuantity = $row['quantity'];
            $storedOptionArray = BasketProductOption::getBasketProductOptionsByProductOrderId($productOrderId);
            if (TransferObject::arraySameContent($storedOptionArray, $optionArray)) {
                Basket::increaseQuantityOfProductInBasket($storedQuantity, $productQuantity, $productOrderId);
                return;
            }
        }
        Basket::addToBasket($productId, $orderId, $productQuantity, $optionArray);
    }

    public static function addToBasket($productId, $orderId, $productQuantity, $optionArray)
    {
        $query = 'select p.pname name, p.price from webshop.product p where p.id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (isset($row)) {
            $productName = $row['name'];
            $productPrice = $row['price'];
            $productOrderId = Order::addNewProductOrder($productId, $orderId, $productQuantity, $productName, $productPrice);
            foreach ($optionArray as $optionId) {
                Order::addNewProductOrderValue($productOrderId, $optionId);
            }
        }
    }

    public static function increaseQuantityOfProductInBasket($storedQuantity, $productQuantity, $productOrderId)
    {
        $query = 'update webshop.product_orders po set po.quantity = ? where po.id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $newQuantity = $storedQuantity + $productQuantity;
        $success = $stmt->bind_param('ii', $newQuantity, $productOrderId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function createNewBasket($personId)
    {
        $query = 'insert into webshop.orders (person_id) values (?)';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $personId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
        $orderId = DB::getLastInsertId();
        return $orderId;
    }

    public static function cleanBasket($personId)
    {
        $query = 'delete from webshop.orders where person_id = ? and state = 0';
        $stmt = DB::prepareWithErrorHandling($query);
        if (!$stmt) {
            return;
        }
        $success = $stmt->bind_param('i', $personId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function removeProductFromBasket($basketProductId)
    {
        $query = 'delete from webshop.product_orders where id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        if (!$stmt) {
            return;
        }
        $success = $stmt->bind_param('i', $basketProductId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
    }
}