<?php

class OrderTableController extends Controller
{
    public function __construct()
    {
        parent::__construct(new OrderTableView(), null);
    }

    public function getContent($products, $remove)
    {
        $this->view->renderOrderTable($this->languageController, $products, $remove);
    }
}