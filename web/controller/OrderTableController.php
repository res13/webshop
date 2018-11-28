<?php

class OrderTableController
{
    public function __construct()
    {
        parent::__construct(new OrderTableView(), null);
    }

    public function getOrderTable($products, $remove)
    {
        $this->view->renderOrderTable($this->languageController, $products, $remove);
    }
}