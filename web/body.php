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

<!--/* ==========================================================================-->
<!--SEARCH BUTTON 2-->
<!--========================================================================== */-->
<!---->
<!--.container-2 {-->
<!--width: 300px;-->
<!--vertical-align: middle;-->
<!--white-space: nowrap;-->
<!--position: relative;-->
<!--}-->
<!---->
<!--.container-2 input#search {-->
<!--width: 50px;-->
<!--height: 50px;-->
<!--border: none;-->
<!--font-size: 10pt;-->
<!--float: left;-->
<!--color: #262626;-->
<!--border-radius: 5px;-->
<!---webkit-transition: width .55s ease;-->
<!---moz-transition: width .55s ease;-->
<!---ms-transition: width .55s ease;-->
<!---o-transition: width .55s ease;-->
<!--transition: width .55s ease;-->
<!--}-->
<!---->
<!--.container-2 .icon {-->
<!--left: 0;-->
<!--margin-left: 10px;-->
<!--margin-top: 11px;-->
<!--position: absolute;-->
<!--top: 50%;-->
<!--z-index: 1;-->
<!--}-->
<!---->
<!--.container-2 input#search:focus, .container-2 input#search:active{-->
<!--outline:none;-->
<!--width: 300px;-->
<!--padding-left: 45px;-->
<!--}-->
<!---->
<!--.container-2:hover input#search{-->
<!--width: 300px;-->
<!--padding-left: 45px;-->
<!--}-->
<!---->
<!--.container-2:hover .icon{-->
<!--color: #93a2ad;-->
<!--}-->

<!--<div class="container-2">-->
<!--    <span class="icon"><i class="fa fa-search"></i></span>-->
<!--    <input type="search" id="search">-->