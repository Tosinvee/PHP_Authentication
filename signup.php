<?php
//Database connection script
include_once 'resources/database.php';
include_once 'resources/validate.php';

// process the form
if(isset($_POST['signupBtn'])){ // checks if the request was submitted
$form_errors = array();

//form validation
$required_fields = array('email', 'username', 'password');

//call the function to check for empty field and merge the return data into form_error array
$form_errors = array_merge($form_errors, check_empty_fields($required_fields)); 

//field that check for minimum lenght
$fields_to_check_length = array('username' => 4, 'password' => 6);

//call the function to check for minimum lenght and merge the return data into form_error array
$form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

//email validation
$form_errors = array_merge($form_errors, check_email ($_POST));



//loop through the required field array
// foreach($required_fields as $name_of_field){
//     if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
//         $form_errors[] = $name_of_field . "is a required field";
//     }
// } 

//check if error array is empty, f yes process data and insert record
if(empty($form_errors)){
    //collect form data
    $email =$_POST['email'];
    $username =$_POST['username'];
    $password =$_POST['password'];


    
// hashed the password using password bycrpt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
// create sql insert statement
    try{
        $sqlInsert = "INSERT INTO users (username, email, password, created_at) 
                    VALUES(:username, :email, :password, now())";

// use PDO prepare to sanitize data
        $statement = $db->prepare($sqlInsert);

//add to the database
        $statement->execute(array(':username' => $username, ':email'=> $email, ':password'=>$hashed_password));
// checks if one new row was created
        if($statement->rowCount() == 1){
            $result = " <p style='padding: 20px; color: green;'>Registration successful</p>";
        };
    }catch(PDOExeception $ex){
        
        $result = "<p style='padding: 20px; color: green;'> Registration failed, An error occured: ".$ex->getMessage()."</p>";
    }
}
else{
   if(count($form_errors) == 1) {
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
    <title>Register Form</title>
</head>
<body>
    <h2>User Authentification System</h2><hr>


    <h3>Signup Form</h3>

    <?php if(isset($result)) echo $result; ?>
    <?php if(!empty($form_errors)) echo show_errors($form_errors) ?>

    <form action="" method="post">
    <table>
        <tr><td>Email:</td> <td><input type="text" value="" name="email"></td></tr>
        <tr><td>Usename:</td> <td><input type="text" value="" name="username"></td></tr>
        <tr><td>Password:</td> <td><input type="password" value="" name="password"></td></tr>
        <tr><td></td> <td><input style="float:right;" type="submit" value="SignUp" name="signupBtn"></td></tr>
        
    </table>
    </form>
    <p> <a href="index.php">Back</a></p>
    
</body>
</html>