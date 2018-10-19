<?php
require('head.php');
if (isset($_SESSION['person'])) {
    cleanBasket($_SESSION['person']->__get('id'));
}
unset($_SESSION['basket']);
header('Location: basket.php');
