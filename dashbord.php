<?php
session_start();
$conn= new PDO("mysql:host=localhost; dbname=gestion", "root", "");
$id=$_SESSION["user-id"];

$query=$conn->query("SELECT * FROM employees");
$users=$query->fetchAll(PDO::FETCH_OBJ);


if(@$_GET["action"]=="delete"){
    $id=@$_GET["id"];
    $query=$conn->prepare("DELETE FROM employees WHERE id=?");
    $query->execute([$id]);
    header("Location: dashbord.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .title{
            display:flex;
        }
        .title form{
            position:absolute;
            top:5%;
            right:38%;
        }
        body{
            color: white;
            background-color: rgba(0, 0, 0, 0.89);
        }
        .content{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }
        
        button{
            padding:4px 16px;
            margin:5px 0;
            border: none;
            border-radius: 10px 20px;
            background-color: rgba(255, 65, 170, 0.829);
            color: white;
        }
    </style>
</head>
<body>
    <div class="content">
    <div class="title">
        <h1>dashbord</h1>
        <form action="add.php">
            <button>add</button>
        </form>
    </div>
    <table>
        <tr>
            <th>first name</th>
            <th>last name</th>
            <th>cin</th>
            <th>email</th>
            <th>phone</th>
            <th>salary</th>
            <th>actions</th>
        </tr>
        <?php foreach($users as $user):?>
            <tr>
                <td><?=$user->first_name;?></td>
                <td><?=$user->last_name;?></td>
                <td><?=$user->cin;?></td>
                <td><?=$user->email;?></td>
                <td><?=$user->phone;?></td>
                <td><?=$user->salary;?></td>
                <td>
                    <form>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $user->id;?>">
                        <button>delete</button>
                    </form>
                    <form action="edit.php">
                        <input type="hidden" name="id" value="<?= $user->id;?>">
                        <button>edit</button>
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    </div>
</body>
</html>