<?php

$conn= new PDO("mysql:host=localhost; dbname=gestion", "root", "");
$id=@$_GET["id"];

$query=$conn->prepare("SELECT * FROM employees WHERE id=?");
$query->execute([$id]);
$user=$query->fetchObject();

if(@$_GET["action"]=="edit"){
    $id1=@$_GET["id"];
    $first_name = @$_GET["first_name"];
    $last_name = @$_GET["last_name"];
    $cin = @$_GET["cin"];
    $email = @$_GET["email"];
    $phone = @$_GET["phone"];
    $salary =@$_GET["salary"];
    $query = $conn->prepare("UPDATE employees SET first_name=?, last_name=?, cin=?, email=?, phone=? ,salary=? WHERE id=?");
    $query->execute([$first_name, $last_name, $cin, $email, $phone, $salary, $id1]);
    header("Location: dashbord.php?id=$id");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="all">
    <form action="" class="content">
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
        <input type="text" id="salary" name="salary" value="<?=$user->salary?>">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= $user->id;?>">
        <button>Edit</button>
    </form>
    </div>
</body>
</html>