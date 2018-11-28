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

    public function render($languageController)
    {
        $result = "<div class=\"navigation\"><a href=\"index.php?siteId=1\"><img class=\"logo\" src=\"img/parachuteshoplogo.png\" alt=\"Parachute webshop\"></a>";
        $productHierarchy = "";
        $result .= "<ul>" . $this->getProductHierarchy(null, $productHierarchy, $languageController) . $productHierarchy;
        $result .= "<li><a href=\"aboutUs.php\">" . $languageController->getTextForLanguage("ABOUT_US") . "</a></li>";
        if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
            $result .= "<li><a href=<\"admin.php\">" . $languageController->getTextForLanguage("ADMIN") . "</a></li>";
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
        $result .= "</div></div>";
        return $result;
    }

    private function getProductHierarchy($category, &$result, $languageController)
    {
        if ($category == null) {
            $result .= "<li><a href=\"products.php\">" . $languageController->getTextForLanguage("PRODUCTS") . "</a>";
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
            getProductHierarchy($subcategory, $result, $languageController);
        }
        $result .= "</ul></li>";
    }
}