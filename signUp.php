<?php
    require_once "dbconfig.in.php";
    include "functions.php";
    session_start();
    if(isset($_SESSION['userID'])){
        echo "you are already registered";
    }
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
    ];
    $errors =[];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $errors = processFormFields1($formFields);
        if(!empty($errors)){
            echo "something wrong";}
        else{
            if(isset($_POST['createEAccount'])){
                header('Location: createAccount.php');
            }
        }
    }
?>
<html>
    <?php include "head.php";?>
    <body>
        <?php include"header.php";?>
        <div class="flex-container">
            <?php include"notSignNav.php";?>                
            <main>
                <form method="post">
                    <fieldset>
                       <legend>user details</legend>
                        <?php generateForm($formFields, $errors);?>  
                    </fieldset>
                    <button type="submit" name="createEAccount" class="submission-button">Create E Account</button>
                </form>
                <p>already have an account? <a href="signIn.php">Sign in here</a></p>
            </main>
        </div>
        <?php include "footer.php";?>
    </body>
</html>