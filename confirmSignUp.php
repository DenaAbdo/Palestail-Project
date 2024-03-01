<?php 
    include "dbconfig.in.php";
    include "functions.php";
    session_start();
    var_dump($_SESSION);
    $formFields = [
        'fullName' => ['label' => 'Name', 'type' => 'text', 'required' => true],
        'userAddress' => ['label' => 'Address', 'type' => 'text', 'required' => true],
        'birthday' => ['label' => 'Date Of Birth', 'type' => 'date', 'required' => true],
        'IdNumber' => ['label' => 'ID Number', 'type' => 'number', 'required' => true],
        'emailAddress' => ['label' => 'Email', 'type' => 'email', 'required' => true],
        'telephone' => ['label' => 'Telephone', 'type' => 'tel', 'required' => true],
        'creditCardNumber' => ['label' => 'Credit Card Number', 'type' => 'number', 'required' => true],
        'creditCardName' => ['label' => 'Credit Card Name', 'type' => 'text', 'required' => true],
        'creditCardExpirationDate' => ['label' => 'ExpirationDate', 'type' => 'date', 'required' => true],
        'creditCardIssuer' => ['label' => 'Bank Issued the Credit Card', 'type' => 'text', 'required' => true],
        'userName' => ['label' => 'Username', 'type' => 'text', 'required' => true],
        'userPassword' => ['label' => 'Password', 'type' => 'password', 'required' => true],
    ];
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $errors = processFormFields1($formFields);
        // If there are no errors, process the form data
        var_dump($_SESSION);
        if (empty($errors)) {
            if(isset($_POST['Confirm'])){
                try {
                    //try transaction
                    $conn->beginTransaction();

                    //user details
                    $query = "INSERT INTO users (fullName, userAddress, birthday, IDNumber, emailAddress, telephone, creditCardID, userName, userPassword) 
                    VALUES (:fullName, :userAddress, :birthday, :IdNumber, :emailAddress, :telephone, :creditCardID, :userName, :userPassword)";
                    
                    $stmt = $conn->prepare($query);
        
                    $formData = [
                        'fullName' => $_SESSION['fullName'],
                        'userAddress' => $_SESSION['userAddress'],
                        'birthday' => date("Y-m-d", strtotime($_SESSION['birthday'])),
                        'IdNumber' => $_SESSION['IdNumber'],
                        'emailAddress' => $_SESSION['emailAddress'],
                        'telephone' => $_SESSION['telephone'],
                        'creditCardID' => $_SESSION['creditCardNumber'],
                        'userName' => $_SESSION['userName'],
                        'userPassword' => $_SESSION['userPassword'],
                    ];                    
                    bindParams($stmt , $formData);
                    $stmt->execute();

                    // if ($stmt->errorCode() !== '00000') {
                    //     throw new PDOException("Error inserting credit card details: " . implode(", ", $stmt1->errorInfo()));
                    $userId = $conn->lastInsertId();// }
                    echo $userId;
                    echo "user details success";
               /* }catch(PDOException $e){
                    echo $e->getMessage();
                }try{*/     
                //     $userID = $_SESSION['userName'];
                //     $query2 = "SELECT userID FROM users WHERE userName = $userID";               
                //    $stmt2 = $conn->prepare($query2);
                //    $result = $stmt2->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
                //    $userID = $result[0];
                //    $stmt2->execute();

                //     $query3 ="INSERT INTO basket(userID) VALUES(:userID)";
                //     $stmt3 = $conn->prepare($query3, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                //    // $newId = $conn->lastInsertId();
                //     $stmt3->bindParam(':userID', $userID);
                //     $stmt3->execute();

                    $query1 = "INSERT INTO creditcard (creditCardNumber, creditCardName, bankIssued, expirationDate) 
                    VALUES (:creditCardNumber, :creditCardName, :bankIssued, :expirationDate)";

                    $stmt1 = $conn->prepare($query1);
                    
                    $formData1 = [
                        'creditCardNumber' => $_SESSION['creditCardNumber'],
                        'creditCardName' => $_SESSION['creditCardName'],
                        'bankIssued' => $_SESSION['creditCardIssuer'],
                        'expirationDate' => date("Y-m-d", strtotime($_SESSION['creditCardExpirationDate'])),
                    ];                    
                    bindParams($stmt1, $formData1);
                    $stmt1->execute();
                    // if ($stmt1->errorCode() !== '00000') {
                    //     throw new PDOException("Error inserting credit card details: " . implode(", ", $stmt1->errorInfo()));
                    // }
                    $query3 ="INSERT INTO basket(userId) VALUES(:userId)";
                    $stmt3 = $conn->prepare($query3);
                   // $newId = $conn->lastInsertId();
                    $stmt3->bindValue(':userId', $userId, PDO::PARAM_INT);
                    $stmt3->execute();
                    $conn->commit();
                    header('Location: login.php');
                    //header('Location: login.php');
                }catch(Exception $e){
                    $conn->rollBack();
                    echo $e->getMessage();
                }
                // try{

                // //     $userName = $_SESSION['userName'];
                // //     $query2 = "SELECT id FROM users WHERE userName = :userName";               
                // //    $stmt2 = $conn->prepare($query2);
                // //    $stmt2->bindParam(':userID', $userName, PDO::PARAM_STR);

                // //    $stmt2->execute();
                // //    $result = $stmt2->fetch(PDO::FETCH_ASSOC);
                // //    $userID = $result['id'];

                    
                // }catch(PDOException $e){
                //     echo $e->getMessage();
                // }
            }
        } 
    }
?>

<html>
    <?php include "head.php"; ?>
    <body>
        <?php include "header.php";?>
        <div class="flex-container">
            <?php include"notSignNav.php";?>                
            <main>
                <form method="POST" action="confirmSignUp.php">
                    <fieldset>
                        <legend>Your Details</legend>
                        <?php
                            generateForm($formFields, $errors);
                        ?>
                    </fieldset>
                    <button type="submit" name="Confirm" class="submission-button">Confirm Details</button>
                </form>
            </main>
        </div>
        <?php include "footer.php"; ?>
    </body>
</html>