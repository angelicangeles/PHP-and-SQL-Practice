<?php
include 'Commands.php';
$class = new Commands();
if($class->checkIfNoData()==TRUE){
    header("location: LogIn.php");
    exit();
}
else{
    header("location: SignUp.php");
    exit();
}