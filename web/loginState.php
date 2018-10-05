<?php
?>
<div class="loginState">
<?php
if (isset($_SESSION['person'])) {
    $person = $_SESSION['person'];
    $username = $person->username;
        echo getTextForLanguage("HELLO")." "."<a href=\"user.php\">".$username."</a>, <a href=\"logout.php\">".getTextForLanguage("LOGOUT")."</a></br></br>";
}
else {
    echo "<a href=\"login.php\">".getTextForLanguage("LOGIN")."</a> or <a href=\"register.php\">".getTextForLanguage("REGISTER")."</a></br></br>";
}
?>
</div>
