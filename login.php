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
    <style>
        *{
            box-sizing:border-box;
            margin:0;
            padding:0;
        }
        body{
            color:white;
            background-color: rgba(0, 0, 0, 0.89);
        }
        form{
            position:absolute;
            top:30%;
            left:38%;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            width:250px;
            height:auto;
            margin:auto;
            border:1px solid grey;
            border-radius: 15px;
            padding:20px;
        }
        input{
            color: white;
            border: none;
            border-radius: 10px;
            padding:5px 20px;
            margin: 8px 0px;
            background-color: rgba(138, 139, 139, 0.61);
            margin:10px 0;
        }
        button{    
            padding:4px 50px;
            margin:10px;
            border: none;
            border-radius: 10px 20px;
            background-color: rgba(255, 65, 170, 0.829);
            color: white;
        }
    </style>
</head>
<body>
    <form method="POST">
        <label for="login">Username:</label>
        <input type="text" name="login" id="login">
        <label for="pass">Password:</label>
        <input type="password" name="password" id="pass">
        <button>Login</button>
    </form>
    <?php echo @$error; ?>
</body>
</html>