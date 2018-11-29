<?php

class NavigationView extends View
{

    private $loginStateController;
    private $basketStateController;

    public function __construct()
    {
        $this->loginStateController = new LoginStateController();
        $this->basketStateController = new BasketStateController();
    }

    public function render(&$languageController)
    {
        $result = "<body><div class=\"navigation\"><a href=\"index.php?site=home\"><img class=\"logo\" src=\"img/parachuteshoplogo.png\" alt=\"Parachute webshop\"></a>";
        $productHierarchy = "";
        $result .= "<ul>" . $this->getProductHierarchy(null, $productHierarchy, $languageController) . $productHierarchy;
        $result .= "<li><a href=\"index.php?site=aboutUs\">" . $languageController->getTextForLanguage("ABOUT_US") . "</a></li>";
        if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
            $result .= "<li><a href=<\"index.php?site=admin\">" . $languageController->getTextForLanguage("ADMIN") . "</a></li>";
        }
        $result .= "</ul>";
        $result .= "<div class=\"navRight\">";
        $result .= $languageController->getContent();
        $result .= "<div class=\"dropdown\">
            <i class=\"faPad fas fa-user fa-3x\"></i>
            <div class=\"dropdown-content\">";
        $result .= $this->loginStateController->getContent();
        $result .= "</div></div>";
        $result .= $this->basketStateController->getContent();
        $result .= "</div></div></body>";
        return $result;
    }

    private function getProductHierarchy($category, &$result, $languageController)
    {
        if ($category == null) {
            $result .= "<li><a href=\"index.php?site=productList\">" . $languageController->getTextForLanguage("PRODUCTS") . "</a>";
            $subcategories = Category::getSubCategories(null);
        } else {
            $result .= "<li><a href=\"index.php?site=productList&category=$category->id\">$category->text</a>";
            $subcategories = Category::getSubCategories($category->categoryid);
        }
        if (empty($subcategories)) {
            return;
        }
        $result .= "<ul>";
        foreach ($subcategories as $subcategory) {
            $this->getProductHierarchy($subcategory, $result, $languageController);
        }
        $result .= "</ul></li>";
    }
}