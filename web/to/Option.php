<?php

class Option extends TransferObject
{
    private $data = array(
        'optionId' => '',
        'optionName' => '',
        'optionValues' => '',
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

    public static function getProductOptions($productId, $lang)
    {
        $query = 'select o.id optionId, i.text_' . $lang . ' optionName
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on o.name_i18n_id = i.id
where p.id = ?
group by optionId';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $options = array();
        while ($row = $result->fetch_assoc()) {
            $option = new Option();
            $option->setAll($row);
            $optionValues = OptionValue::getProductOptionValues($productId, $option->__get('optionId'), $lang);
            $option->__set('optionValues', $optionValues);
            array_push($options, $option);
        }
        return $options;
    }
}