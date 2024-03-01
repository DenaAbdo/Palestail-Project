<?php
    include "dbconfig.in.php";
    include "functions.php";
    session_start();

    $formData = [
        'userName' => ['label' => 'user Name', 'type' => 'text', 'required' => true],
        'password' => ['label' => 'Password', 'type' => 'password', 'required' => true],
    ];
    $errors=[];
    if(isset($_POST['loginBtn'])){
        $errors = processFormFields1($formData);
        if(empty($errors)){
            try {
                $userName = $_SESSION['userName'];
                $userPassword = $_SESSION['password'];

                $query = "SELECT id,userPassword, userType FROM users WHERE userName = :userName AND userPassword = :userPassword LIMIT 1";
                $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
                $stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);

                $stmt->execute();
                $count = $stmt->rowCount();  
                if ($count == 1){
                    while($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)){
                        if($row[1] == $userPassword){
                            $_SESSION['userId'] = $row['0'];
                            echo $_SESSION['userId'];
                            $_SESSION['userType']= $row['2'];
                            echo $_SESSION['userType'];
                        }
                        else{
                            $errors['password'] = "password is not correct";
                            echo "password is not correct";
                        }
                    }
                }
                header("Location: home.php"); 
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }   
    }
?>

<html>
    <?php include "head.php";?>
    <title>Sign In</title>
    <body> 
        <?php include "header.php";?>
        <div class="flex-container">
            <?php include "nav.php";?>
            <main>
                <form method="post" action="login.php">
                    <fieldset>
                        <legend>Sign in</legend>
                        <?php generateForm($formData, $errors); ?>
                    </fieldset>
                    <button type="submit" name="loginBtn"class="submission-button">Log in</button>
                </form>
            </main>
        </div>
        <?php include "footer.php";?>
    </body>
</html>
