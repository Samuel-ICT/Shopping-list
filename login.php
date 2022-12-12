<?php
include "database.php";


// if(isset($_SESSION['user']) && $_SESSION['user'] === true){
//     header("location: shoppinglist.php");
//     exit();
// }

if(!empty($_POST)){
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

   if(isset($_POST['submit'])){
    // $username = $_POST['username'];
    // $password = $_POST['password'];

    $stmt= $db_conn->prepare("SELECT * FROM users WHERE username = ? ");
    $stmt->bindValue(1,$username,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result){
        // header("Location: login.php");
        print("Wrong username");
    }elseif($result['password'] != $password){
        print("Wrong password");
    }else{
        $_SESSION["id"] = $result['id'];
        $_SESSION["username"] = $result['username'];
        header("Location: shoppinglist.php");
        exit;
    }
   }
    }
    // print_r($result['username']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
   <form action="login.php" action="shoppinglist.php" method="POST">
   <label for="user"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" name="submit">Login</button>
   </form> 
</body>
</html>