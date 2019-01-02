<?php

class BasketStateView extends View
{
    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        return $this->renderWithCounter($languageController, 0);
    }

    public function renderWithCounter(&$languageController, $productCount)
    {
        $result = "<body><div class=\"icon-wrapper\">
    <a href=\"basket\" class=\"button\"><img class=\"faPad\" src=\"img/shopping_cart.png\"></a>
    <a href=\"basket\" class=\"badge\">" . $productCount . "</a>
</div></body>";
        return $result;
    }
}