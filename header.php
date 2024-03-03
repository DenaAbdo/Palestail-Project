<header>
    <nav>
        <a href="home.php"> <img src="res/logo.png" alt="logo" width="20px" height="20px"></a>
        <a href="aboutUs.php" >About us</a>
        <a href="userProfile.php">user Profile</a>
        <a href="viewCart.php">basket</a>
        <a href="searchProduct.php"> <img src="res/searchIcon.png" width="20px" height="20px"><input type="text" /> </a>
        <?php
            if(isset($_SESSION['userId'])){
                ?> <a href="destroySession.php">Log out</a><?php
            }else{?>
                <a href="login.php">log in</a>
                <?php
                echo "<p>there is no user logged in</p>";
            }
        ?>
    </nav>
</header>