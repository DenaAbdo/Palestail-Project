<?php
require_once "dbconfig.in.php";
include "functions.php";
session_start();
$formFields = ['userName' => ['label' => 'Username', 'type' => 'text', 'required' => true],
'userPassword' => ['label' => 'Password', 'type' => 'password', 'required' => true],
'userPasswordRepeat' => ['label' => 'Repeat Password', 'type' => 'password', 'required' => true],
];
$errors=[];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $errors = processFormFields1($formFields);
    if($_POST['userPassword'] != $_POST['userPasswordRepeat']){
         echo "passwords are not identical";
         $errors['userPassword'] = "{$formFields['userPassword']['label']} are not identical.";
    }
    if(empty($errors)){
        if(isset($_POST['createAccountBtn'])){
            $_SESSION['userPassword'] = $_POST['userPassword'];
            header('Location: confirmSignUp.php');
        }
    }
    else{
        echo "something wrong with your data";
    }        
}
?>
<html>
    <head>
        <?php include "head.php";?>
    </head>
    <body>
        <?php include"header.php";?>
        <div class="flex-container">
            <?php include"notSignNav.php";?>                
            <main>
                <form action="createAccount.php" method="post">
                    <fieldset>
                        <legend>make e-account</legend>
                        <?php generateForm($formFields, $errors);?>
                        <button type="submit" name="createAccountBtn" class="submission-button">Create Account</button>
                    </fieldset>
                </form>
            </main>
        </div>
        <?php include "footer.php";?>   
    </body>
</html>