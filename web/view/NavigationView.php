<?php

class NavigationView extends View
{

    private $languageController;
    private $authenticationController;
    private $basketController;

    public function __construct()
    {
        $this->languageController = new LanguageController();
        $this->authenticationController = new AuthenticationController();
        $this->basketController = new BasketController();
    }

    public function render()
    {
        $result = "<div class=\"navigation\"><a href=\"index.php\"><img class=\"logo\" src=\"img/parachuteshoplogo.png\" alt=\"Parachute webshop\"></a>";
        $productHierarchy = "";
        $result .= "<ul>" . $this->getProductHierarchy(null, $productHierarchy) . $productHierarchy;
        $result .= "<li><a href=\"aboutUs.php\">" . getTextForLanguage("ABOUT_US") . "</a></li>";
        if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
            $result .= "<li><a href=<\"admin.php\">" . getTextForLanguage("ADMIN") . "</a></li>";
        }
        $result .= "</ul>";
        $result .= "<div class=\"navRight\">";
        $result .= $this->languageController->getContent();
        $result .= "<div class=\"dropdown\">
            <i class=\"faPad fas fa-user fa-3x\"></i>
            <div class=\"dropdown-content\">";
        $result .= $this->authenticationController->getContent();
        $result .= "</div></div>";
        $result .= $this->basketController->getContent();
        $result .= "</div></div>";
        return $result;
    }

    private function getProductHierarchy($category, &$result)
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