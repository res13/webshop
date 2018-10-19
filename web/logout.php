<?php
require('head.php');
unset($_SESSION['person']);
unset($_SESSION['basket']);
redirect('index.php');
