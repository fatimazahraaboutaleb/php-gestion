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
    <h1>dashbord</h1> <button>add</button>
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
</body>
</html>