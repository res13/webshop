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
        $stmt = DB::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $productId);
        DB::checkBindingError($success);
        DB::executeWithErrorHandling($stmt);
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