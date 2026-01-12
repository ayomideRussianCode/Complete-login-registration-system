<?php
include_once 'resource/Database.php';

if(isset($_POST['email'])){

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   try{
     $sql = " INSERT INTO users (username, email, password, join_date)
    VALUES (:username, :email , :password, now())
    ";

    $stmt = $db->prepare($sql);
    $stmt->execute(array(':username'=>$username, ':email'=> $email, ':password'=>$hashed_password));

    if($stmt->rowCount() == 1){

       $message =  "<p style = 'padding: 20px; color: green;' > Registration successful </p>" ;
    }
} catch (PDOException $e) {

           $message = "<p style = 'padding: 20px; color: red;' > An error occurred: ".$e->getMessage()." </p>";

}

}

    var_dump($_POST);

?>



<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>Register Page</title>
</head>

<body>
    <h2>User Authentication System </h2>

    <h3>Registration Form</h3>

 
    <?php 
    if(isset($message)) echo $message;
     ?>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Email:
                <td><input type="text" value="" name ="email"></td>
                </td>
            </tr>
            <tr>
                <td>Username:
                <td><input type="text" value="" name="username"></td>
                </td>
            </tr>

            <tr>
                <td>Password:
                <td><input type="password" value="" name="password"></td>
                </td>
            </tr>

            <tr>
                <td>
                <td><input style="float: right;" type="submit" value="Sign up"></td>
                </td>
            </tr>


        </table>
    </form>

    <p> <a href="index.php">Back</a></p>


</body>

</html>