<?php
    include "dbconfig.in.php";
    include "functions.php";
    session_start();
    // $cookie_name = "user";
    // $cookie_value = array();
    // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    $formFields;
    $errors;

    $formFields = [

        'productName' => ['label' => 'Name', 'type' => 'text', 'required' => true],
        'minPrice' => ['label' => 'Minimum Price', 'type' => 'number', 'required' => true],
        'maxPrice' => ['label' => 'Maximum Price', 'type' => 'number', 'required' => true],
    ];

    $errors = processFormFields1($formFields);
    $productName = $_POST['productName'];
?>
<html>
    <?php include "head.php";?>
    <body>
        <?php include "header.php";?>

        <div class="flex-container">
            <?php include "nav.php"?>
            <main>
                <form method="post" >
                    <?php 
                        generateForm($formFields, $errors);
                    ?>
                    <button type="submit" name="searchBtn" class="submission-button">Search Products</button>
                </form> 
                <table>
                    <thead>
                        <th><button class="submission-button">checkBox</button></th>
                        <th>product ID</th>
                        <th>product price</th>
                        <th>product category</th>
                        <th>quantity</th>
                    </thead>
                    <body>
                        <?php
                            
                        if(isset($_POST['searchBtn'])){
                            if(empty($errors)){
                                $minPrice = $_POST['minPrice'];
                                $maxPrice = $_POST['maxPrice'];
                                $query = "SELECT productId, productPrice, productCategory, quantity FROM product
                                 WHERE productName LIKE :productName AND 
                                productPrice >= :minPrice AND productPrice <= :maxPrice";
                                $productName = $productName . '%';

                                $stmt=  $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                                $stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
                                $stmt->bindValue(':minPrice', $minPrice, PDO::PARAM_INT);
                                $stmt->bindValue(':maxPrice', $maxPrice, PDO::PARAM_INT);

                                $stmt->execute();

                                while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                                    ?><tr>
                                        <td><input type="checkbox"/></td>
                                        <td><a href="viewProduct.php?productID=<?php echo $row[0]?>"><?php echo $row[0]?></td>
                                        <td><?php echo $row[1]?></td>
                                        <td><?php echo $row[2]?></td>
                                        <td><?php echo $row[3]?></td>
                                    </tr><?php
                                }
                        }
                    }?>
                    </body>
                </table>
            </main>
        </div>
        <?php include "footer.php"; ?>
    </body>
</html>