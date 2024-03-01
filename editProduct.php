<?php
    include "dbconfig.in.php";
    session_start();

    $productID = isset($_GET['productID']) ? $_GET['productID'] : null;
    $productQuantity = isset($_GET['newQuantity']) ? $_GET['newQuantity'] : null;
    echo $productQuantity;
    echo $productID;

    try{
        $query ="UPDATE product SET quantity= :productQuantity WHERE productId = :productId";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':productQuantity', $productQuantity, PDO::PARAM_INT);
        $stmt->bindValue(':productId', $productID, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "Update successful!";
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Update failed. Error: " . $errorInfo[2];
        }
        //echo $stmt->rowCount() . " records UPDATED successfully";

    } catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }
?>
