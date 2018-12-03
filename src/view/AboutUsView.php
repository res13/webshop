<?php

class AboutUsView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
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