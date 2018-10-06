<?php

function getProductHierarchy($category, &$result)
{
    if ($category == null) {
        $result .= "<li><a href=\"product.php\">". getTextForLanguage("PRODUCTS"). "</a>";
        $subcategories = getSubCategories(null);
    }
    else {
        $result .= "<li><a href=\"product.php?category=$category->id\">$category->text</a>";
        $subcategories = getSubCategories($category->categoryid);
    }
    if (empty($subcategories)) {
        return;
    }
    $result .= "<ul>";
    foreach ($subcategories as $subcategory) {
        getProductHierarchy($subcategory, $result);
    }
    $result .= "</ul></li>";
}

?>
<div class="navigation">
<ul class="main-navigation">
    <li><a href="index.php"><?php echo getTextForLanguage("HOME") ?></a></li>
<!--    <li><a href="product.php">--><?php //echo getTextForLanguage("PRODUCTS") ?><!--</a>-->
<!--    <ul>-->
        <?php
        getProductHierarchy(null, $productHierarchy);
        echo $productHierarchy;
        ?>
<!--    </ul></li>-->
    <li><a href="aboutUs.php"><?php echo getTextForLanguage("ABOUT_US") ?></a></li>
</ul>
</div>