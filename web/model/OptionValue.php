<?php

class OptionValue extends TransferObject
{
    private $data = array(
        'optionValueId' => '',
        'optionValueName' => '',
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

    public static function getProductOptionValues($productId, $optionId, $lang)
    {
        $query = 'select ov.id optionValueId, i.text_' . $lang . ' optionValueName
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on ov.name_i18n_id = i.id
where p.id = ?
and o.id = ?
group by optionValueId';
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ii', $productId, $optionId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $optionValues = array();
        while ($row = $result->fetch_assoc()) {
            $optionValue = new OptionValue();
            $optionValue->setAll($row);
            array_push($optionValues, $optionValue);
        }
        return $optionValues;
    }
}