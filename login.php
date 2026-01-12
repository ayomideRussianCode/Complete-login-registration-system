<?php
include_once 'resource/Database.php';

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

    <form method="post" action="">
        <table>
            <tr>
                <td>Username:
                <td><input type="text" value=""></td>
                </td>
            </tr>

            <tr>
                <td>Password:
                <td><input type="password" value=""></td>
                </td>
            </tr>

            <tr>
                <td>
                <td><input style="float: right;" type="submit" value="Sign in"></td>
                </td>
            </tr>


        </table>
    </form>

    <p> <a href="index.php">Back</a></p>


</body>

</html>