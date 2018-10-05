<?php
if (isset($_POST['lang']) && in_array($_POST['lang'], getAvailableLanguages())) {
    $_SESSION['lang'] = $_POST['lang'];
    if (isset($_SESSION['person'])) {
        $_SESSION['person']->lang = $_POST['lang'];
        setLanguageOfPerson($_SESSION['person']->id, $_POST['lang']);
    }
}
else{
    if (isset($_SESSION['person'])) {
        $lang = getLanguageOfPerson($_SESSION['person']->id);
        $_SESSION['person']->lang = $lang;
        $_SESSION['lang'] = $lang;
    }
    else {
        $_SESSION['lang'] = getDefaultLanguage();
    }
}
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