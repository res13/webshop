<?php

class HomeView extends View
{

    public function render()
    {
        $result = "<body class=\"landing\"><div class=\"main top topright\"><form method=\"post\"><label><select class=\"styled-select rounded top-selector\" name=\"lang\" onchange=\"this.form.submit()\">";
        foreach (getAvailableLanguages() as $lang) {
            if ($lang === $_SESSION['lang']) {
                $result .= "<option value=\"" . $lang . "\" selected>" . $lang . "</option>";
            } else {
                $result .= "<option value=\"" . $lang . "\">" . $lang . "</option>";
            }
        }
        $result .= "</select></label><noscript><input type=\"submit\" value=\"" . getTextForLanguage("CHANGE_LANGUAGE") . "\"
                            </noscript>
                        </form>
                    </div>
                    <div class=\"main top topleft\">
                        <div class=\"bigTitle\">" . getTextForLanguage("PARACHUTE_SHOP") . "</div>
                        <hr>
                        <div class=\"smallTitle\">" . getTextForLanguage("WELCOME_TEXT") . "</div>
                        <div class=\"smallerTitle\">" . getTextForLanguage("WELCOME_SUB_TEXT") . "</div>
                    </div>
                    <a class=\"centerButton rounded\" href=\"products.php\">" . getTextForLanguage("PRODUCTS") . "</a>
                </body>";
        return $result;
    }
}