<?php

class OrderView extends View
{

    private $orderTableController;

    public function __construct()
    {
        $this->orderTableController = new OrderTableController();
    }

    public function render($languageController)
    {
        // use renderOrderList
    }

    public function renderOrderList($languageController, $orderList)
    {
        $result = " <div class=\"main\">
        <h1>" . $languageController->getTextForLanguage("MY_ORDERS") . "</h1>
        <div class=\"accordion vertical\">
            <ul>";
        foreach ($orderList as $order) {
            $result .= "
                    <li>
                        <input type=\"checkbox\" id=\"" . htmlentities($order->id) . "\" name=\"checkbox-accordion\"/>
                        <label for=\"" . htmlentities($order->id) . "\">
                            #" . htmlentities($order->id) . "</td> -
                            " . htmlentities($order->purchasedate) . " -
                            " . htmlentities($order->paymentmethod) . " -
                            " . htmlentities($order->state) . "
                        </label>
                        <div class=\"content\">";
            $result .= $this->orderTableController->getContent($order->products, false);
            $result .= "</div></li>";
        }
        $result .= "</ul></div></div>";
        return $result;
    }

}