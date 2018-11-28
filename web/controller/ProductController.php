<?php

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct(new ProductView(), "PRODUCT");
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
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
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
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ii', $productId, $optionId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
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

    public static function getProduct($productId, $lang)
    {
        $query = 'select p.id,
       p.productnumber,
       p.pname                                                      name,
       p.price,
       i.text_' . $lang . '                                                    description,
       p.image,
       (select text_' . $lang . ' from webshop.i18n where id = c.name_i18n_id) category,
       m.name                                                       manufacturer
from webshop.product p
       join webshop.i18n i on p.description_i18n_id = i.id
       join webshop.category c on p.category_id = c.id
       join webshop.manufacturer m on p.manufacturer_id = m.id
where p.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (isset($row)) {
            $product = new Product();
            $product->setAll($row);
            return $product;
        }
        return null;
    }
}