<?php

class Product extends TransferObject
{
    private $data = array(
        'id' => '',
        'productnumber' => '',
        'name' => '',
        'price' => '',
        'description' => '',
        'image' => '',
        'category' => '',
        'manufacturer' => '',
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