<?php
include('TransferObject.php');

class Person extends TransferObject
{
    private $data = array(
        'id' => '',
        'firstname' => '',
        'lastname' => '',
        'username' => '',
        'email' => '',
        'birthdate' => '',
        'phone' => '',
        'passwordhash' => '',
        'street' => '',
        'homenumber' => '',
        'city' => '',
        'zip' => '',
        'country' => '',
        'role' => '',
        'lang' => '',
        'resetpassword' => '',
    );

    public function setAll($dataArray) {
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