<?php
include "dbconfig.in.php";
include "functions.php";
session_start();
if ((isset($_SESSION['userType']))){
echo $_SESSION['userType'];
}
echo ((isset($_SESSION['userID'])));
?>

<!DOCTYPE html>
<html>
    <?php include "head.php";?>
    <body>
        <?php include "header.php";?>
        <div class="flex-container">
            <?php include "nav.php";?>
            <main>
                <?php $query = "SELECT imageName, productName, productPrice, productId FROM product";
                $stmt =$conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                    $data = $row;

                    $imageName = $row[0];
                    $productName = $row[1];
                    $productPrice = $row[2];
                    $productID = $row[3];
                
                ?><div class="product">
                    <figure>
                        <img src="<?php echo $imageName; ?>" alt="<?php echo $productName; ?>">
                        <figcaption>
                            <p class="product-name"><?php echo $productName;?></p>
                            <p class="product-price"><?php echo $productPrice;?> </p>
                            <a href="viewProduct.php?productID=<?php echo $productID?>">
                                <img src="src/edit.png" alt="this should be the icon of editing for the employee or add to cart for 
                                customer" />
                            </a>
                        </figcaption>
                    </figure>
                </div>
        <?php } ?>
            </main>
        </div>
        <?php include "footer.php";?>
    </body>
</html>