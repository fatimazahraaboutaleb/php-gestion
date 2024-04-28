<?php
session_start();

$id=@$_SESSION["user-id"];
$role=@$_SESSION["user-role"];
if($id){
    if($role==1){
        header("Location:dashbord.php");
    }
    else{
        header("Location:profil.php");
    }
}
else{
    header("Location:login.php");
}
?>