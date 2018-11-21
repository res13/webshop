<?php
require('head.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
<?php echo getHTMLHead(getTextForLanguage("HOME")); ?>
</head>
<body class="landing">
<div class="main top topright">
    <form method="post">
        <label><select class="styled-select rounded top-selector" name="lang" onchange="this.form.submit()">
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
<div class="main top topleft">
    <div class="bigTitle"><?php echo getTextForLanguage("PARACHUTE_SHOP"); ?></div>
    <hr>
    <div class="smallTitle"><?php echo getTextForLanguage("WELCOME_TEXT"); ?></div>
    <div class="smallerTitle"><?php echo getTextForLanguage("WELCOME_SUB_TEXT"); ?></div>
</div>
<a class="centerButton rounded" href="products.php"><?php echo getTextForLanguage("PRODUCTS") ?></a>
</body>
</html>