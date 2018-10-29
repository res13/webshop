<?php

class BasketProductOption extends TransferObject
{
    private $data = array(
        'optionValueId' => '',
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

    public static function getBasketProductOptionsByProductOrderId($productOrderId)
    {
        $query = 'select poov.optionvalue_id optionValueId 
from webshop.product_orders_option_value poov
where poov.productorders_id = ?';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productOrderId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $productOptionIds = array();
        while ($row = $result->fetch_assoc()) {
            array_push($productOptionIds, $row['optionValueId']);
        }
        return $productOptionIds;
    }
}