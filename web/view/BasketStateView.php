<?php

class BasketStateView extends View
{
    public function render($languageController)
    {
        return $this->renderWithCounter($languageController, 0);
    }

    public function renderWithCounter($languageController, $productCount)
    {
        $result = "<body><div class=\"icon-wrapper\">
    <a href=\"index.php?site=basket\" class=\"button\"><i class=\"faPad fas fa-shopping-cart fa-3x\"></i></a>
    <span class=\"badge\">" . $productCount . "</span>
</div></body>";
        return $result;
    }
}