<?php

class ProductController extends Controller
{
    public function __construct()
    {
        $productView = new ProductView();
        parent::__construct($productView, "PRODUCT");
    }

    public function getContent()
    {
        if (isset ($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
        } else {
            UtilityController::redirect("notFound");
        }
        $product = self::getProduct($id, $_SESSION['lang']);
        $productOptions = self::getProductOptions($id, $_SESSION['lang']);
        $result = $this->navigationController->getContent();
        $result .= $this->view->renderProduct($this->languageController, $product, $productOptions);
        return $result;
    }

    public static function getProductOptions($productId, $lang)
    {
        $query = 'select o.id optionId, i.text_' . $lang . ' optionName
from product p
       join product_option_value pov on p.id = pov.product_id
       join option_value ov on pov.optionvalue_id = ov.id
       join options o on ov.options_id = o.id
       join i18n i on o.name_i18n_id = i.id
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
            $optionValues = self::getProductOptionValues($productId, $option->__get('optionId'), $lang);
            $option->__set('optionValues', $optionValues);
            array_push($options, $option);
        }
        return $options;
    }

    public static function getProductOptionValues($productId, $optionId, $lang)
    {
        $query = 'select ov.id optionValueId, i.text_' . $lang . ' optionValueName
from product p
       join product_option_value pov on p.id = pov.product_id
       join option_value ov on pov.optionvalue_id = ov.id
       join options o on ov.options_id = o.id
       join i18n i on ov.name_i18n_id = i.id
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
       p.pname                                                      name,
       p.price,
       i.text_' . $lang . '                                                    description,
       p.image,
       (select text_' . $lang . ' from i18n where id = c.name_i18n_id) category,
       m.name                                                       manufacturer
from product p
       join i18n i on p.description_i18n_id = i.id
       join category c on p.category_id = c.id
       join manufacturer m on p.manufacturer_id = m.id
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

    public static function getAllManufacturers() {
        $query = 'select m.id id, m.name name from manufacturer m';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $manufacturers = array();
        while ($row = $result->fetch_assoc()) {
            $manufacturer = new Manufacturer();
            $manufacturer->setAll($row);
            array_push($manufacturers, $manufacturer);
        }
        return $manufacturers;
    }

    public static function getAllCategories($lang) {
        $query = 'select c.id, i.text_' . $lang . ' text, c.category_id categoryid
from category c
join i18n i on c.name_i18n_id = i.id';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $categories = array();
        while ($row = $result->fetch_assoc()) {
            $category = new Category();
            $category->setAll($row);
            array_push($categories, $category);
        }
        return $categories;
    }

    public static function addProduct($productName, $brandId, $categoryId, $descriptionEn, $descriptionDe, $price, $uploadfile)
    {
        $i18nId = LanguageController::addText($descriptionDe, $descriptionEn);
        $query = 'INSERT INTO product(pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('sissii', $productName, $price, $i18nId, $uploadfile, $categoryId, $brandId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
        return DatabaseController::getLastInsertId();
    }

    public static function addProductOption($productId, $optionValueId)
    {
        $query = 'INSERT INTO product_option_value(product_id, optionvalue_id) VALUES (?, ?)';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('ii', $productId, $optionValueId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
        return DatabaseController::getLastInsertId();
    }

    public static function removeProduct($productId)
    {
        $query = 'delete from product where id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        if (!$stmt) {
            return;
        }
        $success = $stmt->bind_param('i', $productId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $stmt->close();
    }

    public static function getAllOptions($lang) {
        $query = 'select o.id optionId, i.text_' . $lang . ' optionName from options o join i18n i on o.name_i18n_id = i.id';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $options = array();
        while ($row = $result->fetch_assoc()) {
            $option = new Option();
            $option->setAll($row);
            $optionValues = self::getAllOptionValues($option->__get('optionId'), $lang);
            $option->__set('optionValues', $optionValues);
            array_push($options, $option);
        }
        return $options;
    }

    public static function getAllOptionValues($optionId, $lang)
    {
        $query = 'select ov.id optionValueId, i.text_' . $lang . ' optionValueName from option_value ov 
        join options o on ov.options_id = o.id
        join i18n i on ov.name_i18n_id = i.id
        and o.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $optionId);
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

}