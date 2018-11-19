<?php
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    $username = $person->__get('username');
    echo "<div class=\"state\" id='loginState'>" . getTextForLanguage("HELLO") . " " . "<a href=\"user.php\">" . $username . "</a>, <a href=\"logout.php\">" . getTextForLanguage("LOGOUT") . "</a></div>";
} else {
    echo "<div class=\"state\" id='loginState'><a href=\"login.php\">" . getTextForLanguage("LOGIN") . "</a> " . getTextForLanguage("OR") . " <a href=\"register.php\">" . getTextForLanguage("REGISTER") . "</a></div>";
}