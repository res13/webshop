<?php

class Orders extends TransferObject
{
    private $data = array(
        'id' => '',
        'person_id' => '',
        'billingfirstname' => '',
        'billinglastname' => '',
        'billingaddress_id' => '',
        'deliveryfirstname' => '',
        'deliverylastname' => '',
        'deliveryaddress_id' => '',
        'purchasedate' => '',
        'paymentmethod' => '',
        'state' => '',
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