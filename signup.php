<?php

//database conn script added

include_once 'resource/Database.php';

//form processing

if (isset($_POST['signup-btn'])) {

    //initialize an array to store any error message from the form

    $form_errors = array();

    //form validation
    $required_fields = array('email', 'username', 'password');

    //loop thru the required fields array
    foreach ($required_fields as $name_of_field) {
        if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {
            $form_errors[] = $name_of_field . " is a required field";
        }
    }

    //check if error array is empty, if yes process form data and insert record
    if (empty($form_errors)) {



        //collect form data and store in variables
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        //hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            //create sql insert stmt
            $sql = " INSERT INTO users (username, email, password, join_date)
    VALUES (:username, :email , :password, now())
    ";

            //use PDO prepared to sanitize data
            $stmt = $db->prepare($sql);

            //insert data into the db
            $stmt->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

            //check if new row was created
            if ($stmt->rowCount() == 1) {

                $message =  "<p style = 'padding: 20px; color: green;' > Registration successful </p>";
            }
        } catch (PDOException $e) {

            $message = "<p style = 'padding: 20px; color: red;' > An error occurred: " . $e->getMessage() . "</p>";
        }
    } else {
    if (count($form_errors) == 1) {

        $message =  "<p style = 'color: red;' > There was 1 error in the form <br>";

        $message .= "<ul style='color:red;'>";

        //loop thru error array and display all items
        foreach ($form_errors as $error) {
            $message .= "<li> {$error}</li>";
        }
        $message .=   "</ul></p>";
    } else {

        $message =  "<p style = 'color: red;'> There were  " . count($form_errors) . " errors in the form <br>";

        $message .= "<ul style='color:red;'>";

        //loop thru error array and display all items
        foreach ($form_errors as $error) {
            $message .= "<li>{$error}</li>";
        }
        $message .= "</ul></p>";
    }
}
}
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
    if (isset($message)) echo $message;
    ?>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Email:
                <td><input type="text" value="" name="email"></td>
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
                <td><input style="float: right;" type="submit" name="signup-btn" value="Sign up"></td>
                </td>
            </tr>


        </table>
    </form>

    <p> <a href="index.php">Back</a></p>


</body>

</html>