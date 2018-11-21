<?php

function getProductHierarchy($category, &$result)
{
    if ($category == null) {
        $result .= "<li><a href=\"products.php\">" . getTextForLanguage("PRODUCTS") . "</a>";
        $subcategories = Category::getSubCategories(null);
    } else {
        $result .= "<li><a href=\"products.php?category=$category->id\">$category->text</a>";
        $subcategories = Category::getSubCategories($category->categoryid);
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
    <?php
    getProductHierarchy(null, $productHierarchy);
    echo $productHierarchy;
    ?>
    <li><a href="aboutUs.php"><?php echo getTextForLanguage("ABOUT_US") ?></a></li>
    <?php
    if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
        echo '<li><a href="admin.php">' . getTextForLanguage("ADMIN") . '</a></li>';
    }
    ?>
</ul>

