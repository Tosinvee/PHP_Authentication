<?php 
include_once 'resources/session.php';
include_once 'resources/database.php';
include_once 'resources/validate.php';

//if the loginbtn is clicked process the form
if(isset($_POST['loginBtn'])){
    //arrays to hold errors
    $form_errors =array();

    //validate form 
$required_field = array('email', 'password');

$form_errors = array_merge($form_errors, check_empty_fields($required_field));

if(empty($form_errors)){
    //collect form from data
    $email = $_POST['email'];
    $password = $_POST['password'];

    //check if user exist in the database
    $sqlQuery = "SELECT * FROM users WHERE email = :email";
    $statement =$db->prepare($sqlQuery);
    $statement->execute(array(':email' => $email));

    while($row = $statement->fetch()){
        $id = $row['id'];
        $hashed_password = $row ['password'];
        $email = $row['username'];

        if(password_verify($password, $hashed_password)){
            $_SESSION['id'] = $id;
            $_SESSION['email'] =$email;
            header("location: index.php");
            exit();
        }else{
            $result ="<p style='padding: 20px; color: red; border: 1px solid gray;'> Invalid usernme or password</p>";
        }
        
    }
}else{
    if(count($form_errors) == 1){
        $result = "<p style='color:red;'> There was an error in the form <br>";

   }else{
    $result = "<p style='color:red;'>There were" .count($form_errors). "errors in the form <br>";

   }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
</head>
<body>
    <h2>User Authentification System</h2><hr>


    <h3>Login Form</h3>

    <?php if(isset($result)) echo $result; ?>
    <?php if(!empty($form_errors)) echo show_errors($form_errors) ?>

    <form action="" method="post"></form>
    <table>
        <tr><td>Email:</td> <td><input type="text" name "email" value=""></td></tr>
        <tr><td>Password:</td> <td><input type="password" name="password" value=""></td></tr>
        <tr><td></td> <td><input style="float:right;" type="submit" name="loginBtn" value="Signin"></td></tr>
        
    </table>

    <p> <a href="index.php">Back</a></p>
    
</body>
</html>