<?php

$conn= new PDO("mysql:host=localhost; dbname=gestion", "root", "");

if(@$_GET["action"]=="add"){
    $first_name=$_GET["first_name"];
    $last_name=$_GET["last_name"];
    $cin=$_GET["cin"];
    $email=$_GET["email"];
    $phone=$_GET["phone"];
    $salary=$_GET["salary"];
    $password=$_GET["pass"];
    $department=$_GET["depar"];
    $role=$_GET["role"];

    $query=$conn->prepare("INSERT INTO employees(first_name,last_name,cin,email,phone,salary,password,department_id,role_id) VALUES(?,?,?,?,?,?,?,?,?)");
    $query->execute([$first_name,$last_name,$cin,$email,$phone,$salary,$password,$department,$role]);
    header("Location: dashbord.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <title>Document</title>
</head>
<body>
   <div class="all">
    <form class="content">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name">
        <label for="cin">Cin:</label>
        <input type="text" id="cin" name="cin">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone">
        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary">
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass">
        <label for="depar">Department</label>
        <input type="text" id="depar" name="depar">
        <label for="role">Role</label>
        <input type="text" id="role" name="role">
        <form>
            <input type="hidden" name="action" value="add">
            <button>Add</button>
        </form>
    </form>
</div>
</body>
</html>