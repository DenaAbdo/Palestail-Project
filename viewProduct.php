<?php

    require "dbconfig.in.php";
    session_start();

    $productID = isset($_GET['productID']) ? $_GET['productID'] : null;
    $query = "SELECT productId, productName, briefDescription, productCategory, productPrice, productSize, quantity, imageName FROM product
    WHERE productId=$productID";
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
        $productID =$row[0];
        $productName = $row[1];
        $briefDescription = $row[2];
        $productCategory = $row[3];
        $productPrice = $row[4];
        $productSize = $row[5];
        $quantity = $row[6];
        $imageName = $row[7];
        $_SESSION['productPrice'] = $productPrice;
    }
    $imagePath = 'images/' ."img" . $productID. "img1".".jpg";
?>
<html>
    <?php include "head.php";?>
    <body>
        <?php include "header.php";?>
        <div class="flex-container">
        <?php include "nav.php"?>
        <main>
            <p>
                <figure>
                    <img src="<?php $imagePath?>" alt="productPhoto"/>
                    <figcaption>
                    <p class="productDescription">Product Description: <?php echo $briefDescription?></p>
                        <ul>
                            <li>Product Name <?php echo $productName ?></li>
                            <li>Product ID: <?php echo $productID ?></li>
                            <li>Price: <?php echo $productPrice?></li>
                            <li>Size: <?php echo $productSize?></li>
                            <li>Quantity: <?php echo $quantity?></li>
                        </ul>
                    </figcaption>
                </figure>
                <p>
                    <!-- if customer then add to cart, if employee then update and delete options -->
                    <?php if($_SESSION['userType'] == "Customer"){ ?>
                    <!-- order Quantity <input type="number" name="productQuantity" placeholder="productQuantity"/>   -->
                    <button type="submit"><a href="addToCart.php?productID=<?php echo $productID;?>">Add to Cart</a></button>
                
                    <?php if(isset($_POST['productQuantity'])) { $_SESSION['productQuantity'] = $_POST['productQuantity'];}} else{
                            ?><a href="editProduct.php?productID=<?php echo $productID;?>">Edit</a><?php
                    }?>
                </p>
            </p>
        </main>
        </div>
        <?php include "footer.php"?>
    </body>
</html>