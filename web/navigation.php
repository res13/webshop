<?php

function getProductHierarchy($category, &$result)
{
    if ($category == null) {
        $result .= "<li><a href=\"products.php\">" . getTextForLanguage("PRODUCTS") . "</a>";
        $subcategories = getSubCategories(null);
    } else {
        $result .= "<li><a href=\"products.php?category=$category->id\">$category->text</a>";
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
<ul>
    <li><a href="index.php"><?php echo getTextForLanguage("HOME") ?></a></li>
    <?php
    getProductHierarchy(null, $productHierarchy);
    echo $productHierarchy;
    ?>
    <li><a href="aboutUs.php"><?php echo getTextForLanguage("ABOUT_US") ?></a></li>
</ul>

