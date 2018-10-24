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
}