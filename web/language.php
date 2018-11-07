<?php
?>
<div class="state">
    <form method="post">
        <label><select class="top-selector" name="lang" onchange="this.form.submit()">
                <?php
                foreach (getAvailableLanguages() as $lang) {
                    if ($lang === $_SESSION['lang']) {
                        ?>
                        <option value="<?php echo $lang ?>" selected><?php echo $lang ?></option><?php
                    } else {
                        ?>
                        <option value="<?php echo $lang ?>"><?php echo $lang ?></option><?php
                    }
                }
                ?>
            </select></label>
        <noscript>
            <input type="submit" value="<?php echo getTextForLanguage("CHANGE_LANGUAGE") ?>"
        </noscript>
    </form>
</div>