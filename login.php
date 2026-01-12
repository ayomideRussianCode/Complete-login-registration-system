<?php
include_once 'resource/Database.php';
include_once 'resource/session.php';
include_once 'resource/utilities.php';

if(isset($_POST['login_btn'])){
    

//array to hold errors

$form_errors = array();

//validate
$required_fields = array('username', 'password');

$form_errors = array_merge($form_errors, check_empty_fields($required_fields));

if(empty($form_errors)){
    //collect form data

    $username = $_POST['username'];
    $password = $_POST['password'];

    //check if user exist in the db

    $sql = " SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->execute((array(':username' => $username)));

    while($row = $stmt->fetch()){
        $id = $row['id'];
        $hashed_password = $row['password'];
        $username = $row['username'];

        if(password_verify($password, $hashed_password)){

            $_SESSION['id'] =  $id;
            $_SESSION['username'] = $username;
            header("location: index.php");
        } else {
            $message = "<p style='padding: 20px; color:red; border: 1px solid gray;'>Invalid username or password</p>";
        }
    }

} else {
    if(count($form_errors ) == 1){
        $message = "<p style='color:red;'>There was an error in the form</p>";
    }else {
        $message =  "<p style='color:red;'>There were " .count($form_errors). " errors in the form</p>";
    }
}
}

?>



<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>

<body>
    <h2>User Authentication System </h2>

    <h3>Login Form</h3>

    <?php if(isset($message)) echo $message; ?>

        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>


    <form method="post" action="">
        <table>
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
                <td><input style="float: right;" name="login_btn" type="submit" value="Sign in"></td>
                </td>
            </tr>


        </table>
    </form>

    <p> <a href="index.php">Back</a></p>


</body>

</html>