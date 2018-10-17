<?php
require('head.php');
if (isset($_SESSION['person'])) {
    cleanBasket($_SESSION['person']->__get('id'));
}
$_SESSION['basket'] = null;
header('Location: basket.php');
