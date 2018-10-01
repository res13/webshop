<?php
$availableLangs = ['de', 'en'];
$defaultLang = 'de';
if (isset($_POST['lang']) && in_array($_POST['lang'], $availableLangs)) {
    $_SESSION['lang'] = $_POST['lang'];
    if (isset($_SESSION['person'])) {
        $_SESSION['person']->setLang($_POST['lang']);
        setLanguageOfPerson($_SESSION['person']->getId(), $_POST['lang']);
    }
}
else{
    if (isset($_SESSION['person'])) {
        $lang = getLanguageOfPerson($_SESSION['person']->getId());
        $_SESSION['person']->setLang($lang);
        $_SESSION['lang'] = $lang;
    }
    else {
        $_SESSION['lang'] = $defaultLang;
    }
}
?>
<form method="post">
    <select name="lang" onchange="this.form.submit()">
        <?php
        foreach ($availableLangs as $lang) {
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
