<?php
session_start();

$conn= new PDO("mysql:host=localhost; dbname=gestion", "root", "");
$id=$_SESSION["user-id"];

if($id){
    $query=$conn-> prepare("SELECT * FROM employees WHERE id=?");
    $query->execute([$id]);
    $user=$query->fetchObject();
}


if(isset($_GET["action"]) && @$_GET["action"]=="modify"){
    $id1=@$_GET["id"];
    $first_name = @$_GET["first_name"];
    $last_name = @$_GET["last_name"];
    $cin = @$_GET["cin"];
    $email = @$_GET["email"];
    $phone = @$_GET["phone"];
    $query = $conn->prepare("UPDATE employees SET first_name=?, last_name=?, cin=?, email=?, phone=? WHERE id=?");
    $query->execute([$first_name, $last_name, $cin, $email, $phone, $id1]);
    header("Location: profil.php");
}

if(@$_GET["action"]=="logout"){
    session_unset();
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profil.css">
</head>
<body>
    <div class="all">
    <form class="content">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?=$user->first_name?>">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?=$user->last_name?>">
        <label for="cin">Cin:</label>
        <input type="text" id="cin" name="cin" value="<?=$user->cin?>">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?=$user->email?>">
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?=$user->phone?>">
        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary" value="<?=$user->salary?>" readonly>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" value="<?=$user->password?>">
        <input type="hidden" name="action" value="modify">
        <input type="hidden" name="id" value="<?= $user->id;?>">
        <button>Edit</button>
    </form>
    <form action="">
        <input type="hidden" name="action" value="logout">
        <button class="logout">Logout</button>
    </form>
    </div>
</body>
</html>