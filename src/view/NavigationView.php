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
        $result .= "<a class='navIcon ' href=\"#overlay\"><img class=\"faPad\" src=\"img/menu.png\"></a>";
        $nav = "";
        $nav .= "<ul class='navOverlay'>" . $this->getProductHierarchy(null, $productHierarchy, $languageController) . $productHierarchy;
        $nav .= "<li><a ";
        if ($this->isMenuActive('aboutUs')) {
            $nav .= "class=\"active\" ";
        }
        $nav .= " href=\"aboutUs\">" . $languageController->getTextForLanguage("ABOUT_US") . "</a></li>";
        if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
            $nav .= "<li><a ";
            if ($this->isMenuActive('admin')) {
                $nav .= "class=\"active\" ";
            }
            $nav .= " href=\"admin\">" . $languageController->getTextForLanguage("ADMIN") . "</a></li>";
        }
        $nav .= "</ul>";
        $result .= "<ul class='nav'>" . $nav . "</div>";
        $result .= "<div class=\"navRight\">";
        $result .= $languageController->getContent();
        $result .= "<div class=\"dropdown\">";
        if (isset($_SESSION['person'])) {
            $result .= " <img class=\"faPad\" src=\"img/person.png\">";
        } else {
            $result .= " <img class=\"faPad\" src=\"img/person_outline.png\">";
        }
        $result .= "<div class=\"dropdown-content\">";
        $result .= $this->loginStateController->getContent($languageController);
        $result .= "</div></div>";
        $result .= $this->basketStateController->getContent();
        $result .= "</div>";
        $result .= "<div id='overlay'><div class='overlayContent'><a href=\"#\"><img class=\"faPad\" src=\"img/close.png\"></i></a>";
        $result .= $nav;
        $result .= "</div></div>";
        return $result;
    }

    private function isMenuActive($menuIdentifier) {
        if (isset($_GET['site'])) {
            return $_GET['site'] === $menuIdentifier;
        }
        return false;

    }

    private function isCategoryActive($categoryId) {
        if (isset($_GET['category'])) {
            return $_GET['category'] == $categoryId;
        }
        return false;
    }

    private function getProductHierarchy($category, &$result, $languageController)
    {
        if ($category == null) {
            $result .= "<li><a ";
            if ($this->isMenuActive('productList')) {
                $result .= "class=\"active\" ";
            }
            $result .= "href=\"productList\">" . $languageController->getTextForLanguage("PRODUCTS") . "</a>";
            $subcategories = NavigationController::getSubCategories(null);
        } else {
            $result .= "<li><a ";
            if ($this->isCategoryActive($category->id)) {
                $result .= "class=\"active\" ";
            }
            $result .= "href=\"productList&category=$category->id\">$category->text</a>";
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