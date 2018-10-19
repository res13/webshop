<?php
require('head.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("CHECKOUT")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo getTextForLanguage("CHECKOUT"); ?></h1>
    <?php
    if (isset($_SESSION['person'])) {
        // todo: checkout process
    } else {
        echo "<p>".getTextForLanguage("MUST_BE_LOGGED_IN_TO_CHECKOUT")."</p>";
        echo "<a href=\"login.php\">" . getTextForLanguage("LOGIN") . "</a> " . getTextForLanguage("OR") . " <a href=\"register.php\">" . getTextForLanguage("REGISTER") . "</a></br></br>";
    }
    ?>
</div>
</body>
</html>


