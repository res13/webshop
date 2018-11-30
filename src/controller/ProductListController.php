<?php

class ProductListController extends Controller
{

    public function __construct()
    {
        $productListView = new ProductListView();
        parent::__construct($productListView, "PRODUCTS");
    }

    public function getContent()
    {
        if (isset ($_GET['category']) && $_GET['category'] > 0) {
            $categoryId = $_GET['category'];
            $categoryPath = "";
            NavigationController::getCategoryPath($categoryId, $_SESSION['lang'], $categoryPath);
        } else {
            $categoryId = null;
            $categoryPath = $this->languageController->getTextForLanguage("PRODUCTS");
        }
        $products = NavigationController::getAllProductsInCategory($categoryId, $_SESSION['lang']);
        $result = $this->navigationController->getContent();
        $result .= $this->view->renderProductList($this->languageController, $products, $categoryPath);
        return $result;
    }

}