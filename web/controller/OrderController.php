<?php

class OrderController extends Controller
{
    public function __construct()
    {
        $orderView = new OrderView();
        parent::__construct($orderView, "MY_ORDERS");
    }

    public function getContent()
    {
        $result = $this->navigationController->getContent();
        if (isset($_SESSION['person'])) {
            $person = $_SESSION['person'];
            $orderList = Order::getOrders($person->id);
            $result .= $this->view->renderOrderList($this->languageController, $orderList);
        }
        else {
            UtilityController::redirect("index.php?site=login");
        }
        return $result;
    }

    public static function addNewProductOrder($productId, $orderId, $productQuantity, $productName, $productPrice)
    {
        $query = 'insert into webshop.product_orders (orders_id, product_id, pname, price, quantity) values (?, ?, ?, ?, ?)';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('iisii', $orderId, $productId, $productName, $productPrice, $productQuantity);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
        return DatabaseController::getLastInsertId();
    }

    public static function addNewProductOrderValue($productOrderId, $optionId)
    {
        $query = 'insert into webshop.product_orders_option_value (productorders_id, optionvalue_id) values (?, ?)';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ii', $productOrderId, $optionId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function orderBasket($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry)
    {
        $cityId = UserController::getOrCreateCity($deliveryCity, $deliveryZip);
        $addressId = UserController::getOrCreateAddress($deliveryStreet, $deliveryHomenumber, $cityId, $deliveryCountry);
        $query = 'update webshop.orders set deliveryfirstname = ?, deliverylastname = ?, deliveryaddress_id = ?, purchasedate = now(), state = 1 where id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ssii', $deliveryFirstname, $deliveryLastname, $addressId, $basketId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function orderBasketBillingDiffers($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry, $billingFirstname, $billingLastname, $billingStreet, $billingHomenumber, $billingCity, $billingZip, $billingCountry)
    {
        Order::orderBasket($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry);
        $cityId = UserController::getOrCreateCity($billingCity, $billingZip);
        $addressId = UserController::getOrCreateAddress($billingStreet, $billingHomenumber, $cityId, $billingCountry);
        $query = 'update webshop.orders set billingfirstname = ?, billinglastname = ?, billingaddress_id = ? where id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ssii', $billingFirstname, $billingLastname, $addressId, $basketId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function getOrder($orderId)
    {
        $query = 'select o.id, o.purchasedate, o.paymentmethod, o.state from webshop.orders o where o.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $orderId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (isset($row)) {
            $order = new Order();
            $order->setAll($row);
            $order->__set('products', BasketController::getBasketProductsByOrderId($orderId));
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
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $personId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
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