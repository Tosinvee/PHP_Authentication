<?php
include_once 'resources/database.php';

if(isset($_POST['email'])){
    $email =$_POST['email'];
    $username =$_POST['username'];
    $password =$_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try{
        $sqlInsert = "INSERT INTO users (username, email, password, created_at) 
                    VALUES(:username, :email, :password, now())";

        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':username' => $username, ':email'=> $email, ':password'=>$hashed_password));

        if($statement->rowCount() == 1){
            $result = " <p style='padding: 20px; color: green;'>Registration successful</p>";
        };
    }catch(PDOExeception $ex){
        $result = "<p style='padding: 20px; color: green;'> Registration failed, An error occured: ".$ex->getMessage()."</p>";
    }
}

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>
<body>
    <h2>User Authentification System</h2><hr>


    <h3>Signup Form</h3>

    <?php if(isset($result)) echo $result; ?>

    <form action="" method="post">
    <table>
        <tr><td>Email:</td> <td><input type="text" value="" name="email"></td></tr>
        <tr><td>Usename:</td> <td><input type="text" value="" name="username"></td></tr>
        <tr><td>Password:</td> <td><input type="password" value="" name="password"></td></tr>
        <tr><td></td> <td><input style="float:right;" type="submit" value="SignUp"></td></tr>
        
    </table>
    </form>
    <p> <a href="index.php">Back</a></p>
    
</body>
</html>