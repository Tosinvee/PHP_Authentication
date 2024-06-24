<?php 
// initaialize variable to hold connection parameters
$username ='root';
$dsn = 'mysql:host=localhost; dbname=test_data';
$password = '';

try{
    //create an instance of the pqo class with the required parameters
    $db = new PDO($dsn, $username, $password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "connected to the database";

}catch(PDOException $ex){
    echo "connection to database failed".$ex->getMessage();

};

?>