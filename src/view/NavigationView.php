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

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<div class=\"navigation\"><a href=\"home\"><img class=\"logo\" src=\"img/parachuteshoplogo.png\" alt=\"Parachute webshop\"></a>";
        $productHierarchy = "";
        $result .= "<a class='navIcon ' href=\"#overlay\"><i class=\"faPad fas fa-bars fa-2x\"></i></a>";
        $nav = "";
        $nav .= "<ul class='navOverlay'>" . $this->getProductHierarchy(null, $productHierarchy, $languageController) . $productHierarchy;
        $nav .= "<li><a href=\"aboutUs\">" . $languageController->getTextForLanguage("ABOUT_US") . "</a></li>";
        if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
            $nav .= "<li><a href=\"admin\">" . $languageController->getTextForLanguage("ADMIN") . "</a></li>";
        }
        $nav .= "</ul>";
        $result .= "<ul class='nav'>" . $nav . "</div>";
        $result .= "<div class=\"navRight\">";
        $result .= $languageController->getContent();
        $result .= "<div class=\"dropdown\">
            <i class=\"faPad fas fa-user fa-3x\"></i>
            <div class=\"dropdown-content\">";
        $result .= $this->loginStateController->getContent($languageController);
        $result .= "</div></div>";
        $result .= $this->basketStateController->getContent();
        $result .= "</div>";
        $result .= "<div id='overlay'><div class='overlayContent'><a href=\"#\"><i class=\"faPad fas fa-times fa-2x\"></i></a>";
        $result .= $nav;
        $result .= "</div></div>";
        return $result;
    }

    private function getProductHierarchy($category, &$result, $languageController)
    {
        if ($category == null) {
            $result .= "<li><a href=\"productList\">" . $languageController->getTextForLanguage("PRODUCTS") . "</a>";
            $subcategories = NavigationController::getSubCategories(null);
        } else {
            $result .= "<li><a href=\"productList&category=$category->id\">$category->text</a>";
            $subcategories = NavigationController::getSubCategories($category->categoryid);
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