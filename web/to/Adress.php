<?php
include('TransferObject.php');

class Adress extends TransferObject
{
    private $data = array(
        'id' => '',
        'street' => '',
        'homenumber' => '',
        'city_id' => '',
        'country_id' => '',
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