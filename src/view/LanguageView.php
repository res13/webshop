<?php

class languageView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<body><div class=\"state\" id=\"languageState\">
                    <form method=\"post\">
                        <label><select class=\"styled-select rounded top-selector\" name=\"lang\" onchange=\"this.form.submit()\">";
        foreach ($languageController->getAvailableLanguages() as $lang) {
            if ($lang === $_SESSION['lang']) {
                $result .= "<option value=\"" . $lang . "\" selected>" . $lang . "</option>";
            } else {
                $result .= "<option value=\"" . $lang . "\">" . $lang . "</option>";
            }
        }
        $result .= "</select></label>
                    <noscript>
                        <input type=\"submit\" value=\"" . $languageController->getTextForLanguage("CHANGE_LANGUAGE") . "\"
                    </noscript>
                    </form>
                </div></body>";
        return $result;
    }
}