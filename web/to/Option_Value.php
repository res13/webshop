<?php
include('TransferObject.php');

class Option_Value extends TransferObject
{
    private $data = array(
        'id' => '',
        'name_i18n_id' => '',
        'options_id' => '',
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