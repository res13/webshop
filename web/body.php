<div class="navigation">
    <a href="index.php"><img class="logo" src="img/parachuteshoplogo.png" alt="Parachute webshop"></a>
<?php
    require_once('navigation.php');
    ?>
    <div class="navRight">
        <?php require_once('language.php'); ?>
        <div class="dropdown">
            <i class="faPad fas fa-user fa-3x"></i>
            <div class="dropdown-content">
                <?php require_once('loginState.php'); ?>
            </div>
        </div>
        <?php
        require_once('basketState.php');
        ?>
    </div>
    </div>

</div>
