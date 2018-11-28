<?php

class AboutUsView extends View
{

    public function render($languageController)
    {
        $result = "<body></body><div class=\"main\">
    <h1>" . $languageController->getTextForLanguage("ABOUT_US") . "</h1>
    <p>" . $languageController->getTextForLanguage("PROJECT_DESCRIPTION") . "</p><br/>
    <p>Flugweg 20</p>
    <p>3000 Bern</p>
</div></body>";
        return $result;
    }
}