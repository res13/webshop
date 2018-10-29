<?php

class Order extends TransferObject
{
    private $data = array(
        'id' => '',
        'purchasedate' => '',
        'paymentmethod' => '',
        'state' => '',
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

    public static function addNewProductOrder($productId, $orderId, $productQuantity, $productName, $productPrice)
    {
        $query = 'insert into webshop.product_orders (orders_id, product_id, pname, price, quantity) values (?, ?, ?, ?, ?)';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('iisii', $orderId, $productId, $productName, $productPrice, $productQuantity);
        Db::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
        return DB::getLastInsertId();
    }

    public static function addNewProductOrderValue($productOrderId, $optionId)
    {
        $query = 'insert into webshop.product_orders_option_value (productorders_id, optionvalue_id) values (?, ?)';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ii', $productOrderId, $optionId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function orderBasket($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry)
    {
        $cityId = Person::getOrCreateCity($deliveryCity, $deliveryZip);
        $addressId = Person::getOrCreateAddress($deliveryStreet, $deliveryHomenumber, $cityId, $deliveryCountry);
        $query = 'update webshop.orders set deliveryfirstname = ?, deliverylastname = ?, deliveryaddress_id = ?, purchasedate = now(), state = 1 where id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ssii', $deliveryFirstname, $deliveryLastname, $addressId, $basketId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function orderBasketBillingDiffers($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry, $billingFirstname, $billingLastname, $billingStreet, $billingHomenumber, $billingCity, $billingZip, $billingCountry)
    {
        Order::orderBasket($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry);
        $cityId = Person::getOrCreateCity($billingCity, $billingZip);
        $addressId = Person::getOrCreateAddress($billingStreet, $billingHomenumber, $cityId, $billingCountry);
        $query = 'update webshop.orders set billingfirstname = ?, billinglastname = ?, billingaddress_id = ? where id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ssii', $billingFirstname, $billingLastname, $addressId, $basketId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function getOrder($orderId)
    {
        $query = 'select o.id, o.purchasedate, o.paymentmethod, o.state from webshop.orders o where o.id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $orderId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (isset($row)) {
            $order = new Order();
            $order->setAll($row);
            $order->__set('products', Basket::getBasketProductsByOrderId($orderId));
            return $order;
        }
        return null;
    }

    public static function getOrders($personId)
    {
        $orderIdList = Order::getOrderIdsOfPerson($personId);
        $orderList = array();
        foreach ($orderIdList as $orderId) {
            $order = Order::getOrder($orderId);
            array_push($orderList, $order);
        }
        return $orderList;
    }

    public static function getOrderIdsOfPerson($personId) {
        $query = 'select o.id from webshop.orders o where o.person_id = ? and o.state = 1';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $personId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $orderIdList = array();
        while ($row = $result->fetch_assoc()) {
            $orderId = $row['id'];
            array_push($orderIdList, $orderId);
        }
        return $orderIdList;
    }
}