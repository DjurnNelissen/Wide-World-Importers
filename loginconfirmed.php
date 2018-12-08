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
    var_dump($_POST);

    //f..
    //check user if exists
    $sql = "select * from people
          where LogonName= '$naam'";
    $stmt = runQuery($sql);
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        if (password_verify($password, $row["HashedPassword"])) {
            LoginSuccesvol($naam, $password);
        } else {
            print('err 3');
          loginfailed();
        }
        //encrypt password
        //komt het wachtwoord overeen
        //login gelukt jha of nee


    } else {
       print('err 1');
           loginfailed();
    }
}else{
    print("err 2");
    loginfailed();
}

function loginfailed(){
    header("Location: login.php?loginfailed=1");
}
function LoginSuccesvol($user, $pass){
    $_SESSION["user"]= array ('name'=> $user,'hash'=> $pass);
    header("Location: index.php");
}




?>
