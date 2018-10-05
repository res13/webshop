<?php
?>
<div class="navigation">
<a href="index.php"><?php echo getTextForLanguage("HOME")?></a>
    <div class="dropdown">
        <button class="dropbtn"><?php echo getTextForLanguage("PRODUCTS")?>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
    </div>
    <a href="aboutUs.php"><?php echo getTextForLanguage("ABOUT_US")?></a>
</div>