<?php
require('../head.php');
?>
<!DOCTYPE html>
<html>
<body>
hoi
<?php
$products = array(getProducts());
echo sizeof($products);
foreach ($products as $product){
    echo $product->getProductnumber();
}
?>
</body>
</html>
