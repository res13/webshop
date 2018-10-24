<?php
require('head.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php echo getHTMLHead(getTextForLanguage("ADMIN")); ?>
</head>
<body>
<?php require('body.php'); ?>
<div class="main">
    <h1><?php echo getTextForLanguage("ADMIN"); ?></h1>
    <?php
    if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
        // todo: admin page
        echo "<p>todo</p>";
    } else {
        echo "<p>".getTextForLanguage("MUST_BE_ADMIN_FOR_THIS_PAGE")."</p>";
    }
    ?>
</div>
</body>
</html>


