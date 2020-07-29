<?php 
    include("check.php");   
?>


    <?php 

    if ($loginst == 1){ ?>
        <div id="nav">
            <ul >
                <li class="navbar-left"><a href="artikelen.html">Men</a></li>
                <li class="navbar-left"><a href="artikelen.html">Women</a></li>
                <li class="navbar-left"><a href="artikelen.html">Kids</a></li>
                <li class="navbar-right"><a href="view_cart.php">Cart (0)</a></li>
                <li class="navbar-right"><a href="inlog.php">My Account</a></li>
            </ul>
        </div>

    <?php } else { ?>
        <div id="nav">
            <ul >
                <li class="navbar-left"><a href="artikelen.html">Men</a></li>
                <li class="navbar-left"><a href="artikelen.html">Women</a></li>
                <li class="navbar-left"><a href="artikelen.html">Kids</a></li>
                <li class="navbar-right"><a href="view_cart.php">Cart (0)</a></li>
                <li class="navbar-right"><a href="inlog.php">Login / Sign Up</a></li>
            </ul>
        </div> 
    <?php } ?>