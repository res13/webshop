<?php

class NavigationController
{
    private $view;

    public function __construct()
    {
        $this->view = new NavigationView();
    }

    public function getContent() {
        $this->view->render();
    }

    function getProductHierarchy($category, &$result)
    {
        if ($category == null) {
            $result .= "<li><a href=\"products.php\">" . getTextForLanguage("PRODUCTS") . "</a>";
            $subcategories = Category::getSubCategories(null);
        } else {
            $result .= "<li><a href=\"products.php?category=$category->id\">$category->text</a>";
            $subcategories = Category::getSubCategories($category->categoryid);
        }
        if (empty($subcategories)) {
            return;
        }
        $result .= "<ul>";
        foreach ($subcategories as $subcategory) {
            getProductHierarchy($subcategory, $result);
        }
        $result .= "</ul></li>";
    }
}