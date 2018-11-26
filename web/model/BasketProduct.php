<?php

class BasketProduct extends TransferObject
{
    private $data = array(
        'id' => '',
        'name' => '',
        'quantity' => '',
        'price' => '',
        'options' => '',
        'realProductId' => '',
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

    function getBasketProduct($basketProductId)
    {
        $query = 'select po.id, po.pname name, po.price, po.quantity, po.product_id realProductId from webshop.product_orders po where po.id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $basketProductId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
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
}