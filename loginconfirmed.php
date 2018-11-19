<?php
session_start();
include_once ("php/db.php");
/**
 * Created by PhpStorm.
 * User: Axel Broek
 * Date: 14-11-2018
 * Time: 15:10
 */
$naam=0;
$password=0;
if (isset($_POST["email"]) && isset($_POST["passwd"])) {
    $naam = $_POST["email"];
    $password = $_POST["passwd"];
    //f..
    //check user if exists
    $sql = "select * from people
          where LogonName=$naam";
    $stmt = runQuery($sql);
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $passwdhash = password_hash($password);
        if (hash_equals($passwdhash, $row[HashedPassword])) {
            LoginSuccesvol($naam, $passwdhash);
        } else {
          loginfailed();
        }
        //encrypt password
        //komt het wachtwoord overeen
        //login gelukt jha of nee


    } else {
       loginfailed();
    }
}else{
    loginfailed();
}

function loginfailed(){
    header("Location: /Wide-World-Importers/login.php?loginfailed=1");
}
function LoginSuccesvol($user, $pass){
    header("Location: /loginconfirmed.php");
    $_SESSION["user"]= array ('name'=> $user,'hash'=> $pass);

}




?>