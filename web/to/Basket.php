<?php

class Basket extends TransferObject
{
    private $data = array(
        'id' => '',
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

    public function getProductIfQuantityGreaterThanZero($productId, $options) {
        $productArray = $this->__get('products');
        foreach ($productArray as $myProduct) {
            $myProductId = $myProduct->__get('id');
            if ($myProductId != $productId) {
                continue;
            }
            $myOptions = $myProduct->__get('options');
            $resultingProduct = $myProduct;
        }
        if (!isset($myOptions)) {
            return null;
        }
        $myOptionsArray = array();
        foreach ($myOptions as $myOption) {
            $myOptionValueId = $myOption->__get('optionValueId');
            array_push($myOptionsArray, $myOptionValueId);
        }
        sort($options);
        sort($myOptionsArray);
        if ($options == $myOptionsArray) {
            return $resultingProduct;
        }
        return null;
    }

    public function removeProduct($productId) {
        $productArray = $this->__get('products');
        foreach ($productArray as $myProduct) {
            $myProductId = $myProduct->__get('id');
            if ($myProductId != $productId) {
                continue;
            }
            $resultingProduct = $myProduct;
        }
        if(($key = array_search($resultingProduct, $productArray, true)) !== FALSE) {
            unset($productArray[$key]);
        }
        $this->__set('products', $productArray);
    }
}