<?php

class BasketView extends View
{
    private $orderTableController;
    private $checkoutController;

    public function __construct()
    {
        $this->orderTableController = new OrderTableController();
        $this->checkoutController = new CheckoutController();
    }

    public function render($languageController)
    {
        $result = "<body><div class=\"main\">
        <h1>" . $languageController->getTextForLanguage("BASKET") . "</h1>";
        $show = (isset($_SESSION['basket']) && count($_SESSION['basket']->products) > 0);
        if ($show) {
            $result .= "<h2><a href='index.php?siteId=8&cleanBasket'>" . $languageController->getTextForLanguage("CLEAN_BASKET") . "</a></h2>";
        }
        $result .= "<div class=\"row\">
            <div class=\"col-75\">
                <div class=\"container\">";
        $show = (isset($_SESSION['basket']) && count($_SESSION['basket']->products) > 0);
        if ($show) {
            $result .= $this->orderTableController->getContent($_SESSION['basket']->products, true);
        } else {
            $result .= "<div class='innerContainer'><p>" . $languageController->getTextForLanguage("BASKET_IS_EMPTY") . "</p></div>";
        }
        $result .= "</div></div>";
        if ($show) {
            $result .= "<div class=\"col-25\">
                <div class=\"container\">
                    <div class=\"innerContainer\">";
            $result .= $this->checkoutController->getContent();
            $result .= "</div>
                </div>
            </div>";
            $result .= "</div></div></body>";
            return $result;
        }
    }
}