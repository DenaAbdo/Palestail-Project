<header>
    e-store name
    <img src="logo.jpg" alt="logo">Logo
    <a href="aboutUs.php" >about us page link</a>
    <a href="userProfile.php">user Profile</a>
    <a href="viewCart.php">basket</a>
    <?php
        if(isset($_SESSION['userId'])){
            ?> <a href="destroySession.php">Log out</a><?php
        }else{?>
            <a href="login.php">log in</a>
            <?php
            echo "<p>there is no user logged in</p>";
        }
    ?>
</header>