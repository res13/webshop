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
    $username = $person->__get('username'); ?>
    <div class="state" id='loginState'><?php echo getTextForLanguage("HELLO") ?>
        <a href="user.php"><?php echo $username ?></a>
        <a href="myOrders.php"><?php echo getTextForLanguage("MY_ORDERS") ?></a>
        <hr/>
        <a href="logout.php"><?php echo getTextForLanguage("LOGOUT") ?></a>
    </div>
<?php } else { ?>
    <div class="state" id='loginState'>
        <a href="login.php"><?php echo getTextForLanguage("LOGIN") ?></a>
        <hr/>
        <a href="register.php"><?php echo getTextForLanguage("REGISTER") ?></a>
    </div>
<?php } ?>