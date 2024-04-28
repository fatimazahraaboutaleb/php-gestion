<?php
session_start();
$conn= new PDO("mysql:host=localhost; dbname=gestion", "root", "");
if (@$_POST["login"] && @$_POST["password"]){
    $username=@$_POST["login"];
    $password=@$_POST["password"];
    $query=$conn->prepare("SELECT * FROM employees WHERE email=:username OR phone=:username AND password=:password");
    $query->bindParam(":username",$username);
    $query->bindParam(":password",$password);
    $query->execute();
    $user=$query->fetchObject();
    if($user){
        $_SESSION["user-id"]=$user->id;
        $_SESSION["user-role"]=$user->role_id;
        if($user->id==1){
            header("Location:dashbord.php");
        }
        else{
            header("Location:profil.php");
        }
    }
    else{
        $error="Invalid username or password";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label for="login">USERNAME</label>
        <input type="text" name="login" id="login">
        <label for="pass">PASSWORD</label>
        <input type="password" name="password" id="pass">
        <button>Login</button>
    </form>
    <?php echo @$error; ?>
</body>
</html>