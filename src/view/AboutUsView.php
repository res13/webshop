<?php

class AboutUsView extends View
{

    public function render(LanguageController &$languageController, $errorMessage = null)
    {
        $result = "<body></body><div class=\"main\">
    <h1>" . $languageController->getTextForLanguage("ABOUT_US") . "</h1>
    <p>" . $languageController->getTextForLanguage("PROJECT_DESCRIPTION") . "</p><br/>
    <p id='ajaxAdress'>
        <script>
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(\"ajaxAdress\").innerHTML = this.responseText;
                }
            };
            xhttp.open(\"GET\", \"resource/adress.txt\", true);
            xhttp.send();
        </script>
        <noscript>
            Flugweg 20<br/>
            3000 Bern
        </noscript>
    </p>
</div></body>";
        return $result;
    }
}