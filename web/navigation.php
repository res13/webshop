<?php
?>
<div class="navigation">
    <a href="index.php"><?php echo getTextForLanguage("HOME") ?></a>
    <div class="dropdown">
        <button class="dropbtn"><?php echo getTextForLanguage("PRODUCTS") ?>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <?php
            $subcategories = getSubCategories(null);
            foreach ($subcategories as $subcategory) {
                echo "<a href=\"#\">$subcategory->text</a>";
                // TODO: make this recursive and handle it in css as well
//                if ($subcategory->categoryid != null) {
//                    $subcategories2 = getSubCategories($subcategory->categoryid);
//                    echo "<div class=\"dropdown-content2\">";
//                    foreach ($subcategories2 as $subcategory2) {
//                        echo "<a href=\"#\">$subcategory2->text</a>";
//                    }
//                    echo "</div>";
//                }
            }
            ?>
        </div>
    </div>
    <a href="aboutUs.php"><?php echo getTextForLanguage("ABOUT_US") ?></a>
</div>