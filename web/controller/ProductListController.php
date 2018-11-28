<?php

class ProductListController extends Controller
{
    private $categoryPath;

    private $products;

    public function __construct()
    {
        if (isset ($_GET['category']) && $_GET['category'] > 0) {
            $categoryId = $_GET['category'];
            $this->categoryPath = "";
            NavigationController::getCategoryPath($categoryId, $_SESSION['lang'], $this->categoryPath);
        } else {
            $categoryId = null;
            $this->categoryPath = $this->languageController->getTextForLanguage("PRODUCTS");
        }
        $this->products = NavigationController::getAllProductsInCategory($categoryId, $_SESSION['lang']);
        parent::__construct(new ProductListView(), "PRODUCTS");
    }

    public function getTitle() {
        return $this->categoryPath;
    }

    public function getContent()
    {
        $result = $this->navigationController->getContent();
        $result .= $this->view->renderProductList($this->languageController, $this->products, $this->categoryPath);
        return $result;
    }

}