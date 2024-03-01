<?php
    require "dbconfig.in.php";
    session_start();

    $productID = isset($_GET['productID']) ? $_GET['productID'] : null;
    $productPrice = isset($_SESSION['productPrice'])?  $_SESSION['productPrice']: null;
    $userId = $_SESSION['userId'];
    //$newQuantity = $_GET['newQuantity'];
    try{
        $conn->beginTransaction();
        $query ="SELECT id FROM basket WHERE userId = :userId";
        $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $basketID =$row[0];
            echo $basketID;
            $_SESSION['basketId'] = $row[0];
        }
        $query1 = "INSERT INTO productslist (basketID,productID, productPrice) 
        VALUES (:basketID,:productID ,:productPrice)" ;
        $stmt1 = $conn->prepare($query1);
        $stmt1->bindValue(':basketID', $basketID);
        $stmt1->bindValue(':productID', $productID);
        $stmt1->bindValue('productPrice', $productPrice);
       // $stmt1->bindValue('productQ', $newQuantity);

        $stmt1->execute();
        $productListId = $conn->lastInsertId();
        echo $productListId;
        $conn->commit();
    }catch(Exception $e){
        $conn->rollBack();
        echo $e->getMessage();
    }
?>
