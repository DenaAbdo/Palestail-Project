<?php
require "dbconfig.in.php";
include 'functions.php';
session_start();
$formFields = [
    'productName' => ['label' => 'Product Name', 'type' => 'text', 'required' => true],
    'briefDescription' => ['label' => 'Product Description', 'type' => 'textarea', 'required' => true],
    'productPrice' => ['label' => 'Product price', 'type' => 'number', 'required' => true],
    'productCategory' => ['label' => 'Product Category', 'type' => 'select', 'options' => [
        'normal' => 'Normal',
        'OnSale' => 'OnSale',
        'newArrival' => 'new arrival',
        'featured' => 'featured',
        'high demand' =>'high demand',
    ], 'required' => true],
    'quantity' => ['label' => 'Product Quantity', 'type' => 'number', 'required' => true],
    'productSize' => ['label' => 'Product Size', 'type' => 'number', 'required' => true],
    'imageName' => ['label' => 'Product Image', 'type' => 'file', 'required' => true],
];
$errors =processFormFields1($formFields);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['addProduct'])){
            if (empty($errors)) {
                try{
                    $query = "INSERT INTO product (productName, briefDescription, productCategory, productPrice, productSize, quantity)
                    VALUES (:productName, :briefDescription, :productCategory, :productPrice, :productSize, :quantity )";
                    $stmt = $conn->prepare($query);
                    echo $_POST['productName'];
                    $formData =[
                        'productName'=>$_POST["productName"],
                        'briefDescription'=>$_POST["briefDescription"],
                        'productCategory'=>$_POST["productCategory"],
                        'productPrice'=>$_POST["productPrice"],
                        'productSize'=>$_POST["productSize"],
                        'quantity'=>$_POST["quantity"],
                    ];
                    bindParams($stmt ,$formData);
                    $stmt->execute();
                    $newId = $conn->lastInsertId();
                    echo "product with id: ".$newId ."added succefully";

                    $target_dir = "images/";
                    $target_file = $target_dir . basename($_FILES["imageName"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
                    $newFileName = "img" . $newId. "img1".".jpg";
                     // Check if image file is a actual image or fake image
                     if(isset($_POST["addProduct"])) {
                        $check = getimagesize($_FILES["imageName"]["tmp_name"]);
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                        if($imageFileType != "jpg" && $imageFileType != "jpeg") {
                        echo "Sorry, only JPG, JPEG files are allowed.";
                        $uploadOk = 0;
                        }
                        if ($uploadOk == 0) {
                            echo "Sorry, your file was not uploaded.";
                          // if everything is ok, try to upload file
                          } else {
                            if (move_uploaded_file($_FILES["imageName"]["tmp_name"], $target_file)) {
                              echo "The file ". htmlspecialchars( basename( $_FILES["imageName"]["name"])). " has been uploaded.";
                            } else {
                              echo "Sorry, there was an error uploading your file.";
                            }
                          }
                        }

                    $query1 = "UPDATE product SET imageName = :imageName WHERE productId = :productID ";
                    $stmt1 = $conn->prepare($query1);
                    $stmt1->bindValue(':imageName', $newFileName);
                    $stmt1->bindValue(':productID', $newId);
                    $stmt1->execute();
                    
                }catch (PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }
            }
        }
        }
?>
<html>
    <?php include "head.php";?>
    <body>
        <?php include"header.php";?>
        <div class="flex-container">
            <?php include"nav.php";?>
            <main>
                <form method="post" action="addProduct.php" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Add new Product</legend>
                        <?php 
                            if(($_SESSION['userType']) == "Employee"){
                                generateForm($formFields, $errors);
                            }else{
                                ?> <label class="error-message">You should be an employee to add a product</label><?php
                            }
                        ?>
                    </fieldset>
                    <button type="submit" class="submission-button required" name="addProduct">Add product</button>
                </form>
            </main>
        </div>
        <?php include "footer.php";?>
    </body>
    <footer>
    </footer>
</html>