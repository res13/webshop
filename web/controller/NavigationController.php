<?php

class NavigationController
{
    private $view;

    private $languageController;

    public function __construct(LanguageController $languageController)
    {
        $this->view = new NavigationView();
        $this->languageController = $languageController;
    }

    public function getContent() {
        return $this->view->render($this->languageController);
    }

    public static function getSubCategories($categoryId)
    {
        if ($categoryId == null) {
            $where = 'is null';
        } else {
            $where = '= ?';
        }
        $query = 'select c.id, 
  i.text_' . $_SESSION['lang'] . ' as text, c.category_id as categoryid
from webshop.category c
            join webshop.i18n i on i.id = c.name_i18n_id
where c.category_id in (select id from webshop.category c where c.category_id ' . $where . ')';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        if ($categoryId != null) {
            $success = $stmt->bind_param('i', $categoryId);
            DatabaseController::checkBindingError($success);
        }
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

    public static function getAllProductsInCategory($categoryId, $lang)
    {
        $mainQuery = 'select p.id,
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
where c.id in ';
        if ($categoryId == null) {
            $query = $mainQuery . '(select c.id from webshop.category c)';
            $stmt = DatabaseController::prepareWithErrorHandling($query);
        } else {
            $query = $mainQuery . '(select id
               from (select * from webshop.category c order by c.category_id, id) category,
                    (select @pv := ?) initialisation
               where find_in_set(category_id, @pv) > 0
                       and @pv := concat(@pv, \',\', id)
               union
               select c.id from webshop.category c where id = ?)';
            $stmt = DatabaseController::prepareWithErrorHandling($query);
            $success = $stmt->bind_param('si', $categoryId, $categoryId);
            DatabaseController::checkBindingError($success);
        }
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $products = array();
        while ($row = $result->fetch_assoc()) {
            $product = new Product();
            $product->setAll($row);
            array_push($products, $product);
        }
        return $products;
    }

    public static function getCategory($categoryId, $lang)
    {
        $query = 'select c.id, i.text_' . $lang . ' text, c.category_id categoryid
from webshop.category c
join webshop.i18n i on c.name_i18n_id = i.id
where c.id = ?';
        $stmt = DatabaseController::prepareWithErrorHandling($query);
        $success = $stmt->bind_param('i', $categoryId);
        DatabaseController::checkBindingError($success);
        DatabaseController::executeWithErrorHandling($stmt);
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if (isset($row)) {
            $category = new Category();
            $category->setAll($row);
            return $category;
        }
        return null;
    }

    public static function getCategoryPath($categoryId, $lang, &$categoryPath)
    {
        $category = Category::getCategory($categoryId, $lang);
        if (empty($categoryPath)) {
            $categoryPath = $category->__get('text');
        } else {
            $categoryPath = $category->__get('text') . " - " . $categoryPath;
        }
        $parentId = $category->__get('categoryid');
        if ($parentId == null) {
            return;
        }
        Category::getCategoryPath($parentId, $lang, $categoryPath);
    }

}