<?php

class OrderTableController extends Controller
{
    public function __construct()
    {
        $orderTableView = new OrderTableView();
        parent::__construct($orderTableView, null);
    }

    public function getContent()
    {

    }

    public function getOrderTable($products, $remove)
    {
        $this->view->renderOrderTable($this->languageController, $products, $remove);
    }
}