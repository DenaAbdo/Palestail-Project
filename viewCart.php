<?php
    include "dbconfig.in.php";
    session_start();
?>
<html>
    <?php include "head.php";?>
    <body> 
        <?php include "header.php";?>
        <div class="flex-contaier">
            <?php include "nav.php";?>
            <main>
                <table>
                    <thead>
                        <th>product id</th>
                        <th>product name</th>
                        <th>product price</th>
                        <th>product quantity</th>
                        <th><a href="removeFromList.php">remove from order</a></th>
                    </thead>
                    <tbody>
                        <?php 
                            try{
                                $query =  "SELECT id FROM basket WHERE userId= :userId";
                                $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                                $stmt->bindValue(':userId', $_SESSION['userId']);
                                $stmt->execute();

                                while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                                    $basketID =$row[0];
                                } 
                                $query= "SELECT pl.id, pl.basketID, pl.productID, pl.productPrice, p.productName
                                FROM productslist pl 
                                JOIN product p ON pl.id = p.productId
                                JOIN basket b ON pl.basketID = b.id 
                                WHERE b.id = :basketId
                                 ";
                                 $stmt=$conn->prepare($query);
                                 $stmt->bindParam(':basketId', $basketID);
                                 $stmt->execute();
                                 $productsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                print_r($productsList);


                                foreach ($productsList as $item) {
                                    echo "<tr>";
                                    echo "<td>" . $item['productID'] . "</td>";
                                    echo "<td>" . $item['productName'] . "</td>";
                                    //echo "<td>" . $item['quantity'] . "</td>";
                                    echo "<td>" . $item['productPrice'] . "</td>";
                                    echo "</tr>";
                                }
                            ?><tr>
                                
                            <?php   }
                            catch(PDOException $e){
                                echo $e->getMessage();
                            }
                            ?>
                    </tbody>
                </table>
            </main>
            <?php include "footer.php";?> 
        </div>
    </body>
</html>