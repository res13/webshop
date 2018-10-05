<?php
?>
<div class="language">
<form method="post">
    <select name="lang" onchange="this.form.submit()">
        <?php
        foreach (getAvailableLanguages() as $lang) {
            if ($lang === $_SESSION['lang']) {
                ?><option value="<?php echo $lang ?>" selected><?php echo $lang ?></option><?php
            }
            else {
                ?><option value="<?php echo $lang ?>"><?php echo $lang ?></option><?php
            }
        }
        ?>
    </select>
</form>
</div>