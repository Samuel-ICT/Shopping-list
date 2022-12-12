<?php
include "database.php";
  
 if(isset($_SESSION['id'])&&isset($_SESSION['username'])){

// Check if POST data is not empty
if (!empty($_POST)) {
  // Post data not empty insert a new record
  // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
  $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
  // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
  $name = isset($_POST['item_name']) ? $_POST['item_name'] : '';
  // Insert new record into the contacts table
  $stmt = $db_conn->prepare('INSERT INTO items VALUES (?,?)');
  $stmt->execute([$id,$name]);
  
 
  
}

  $items = $db_conn->query('SELECT * FROM items');
  $item_names =  $items->fetchAll(PDO::FETCH_ASSOC);





?>
<!-- <?php print_r($_SESSION['id']); ?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping List</title>
    <style>
      .hide{
        display: none;
      }
      .show{
        display: block;
      }
      input[type=checkbox]:checked + label#cbox {
      color:red;
      text-decoration: line-through;
      } 
    </style>
</head>
<body>

<h2>Welcome to your shoppinglist, <?=$_SESSION['username']?></h2>
  <form action="delete.php" method="post">
    <button type="submit" name = "delete">Delete</button><br><br>
    <?php foreach ($item_names as $item ):?>
    <tr>
      <input type="checkbox"  name="cbox[]" value="<?=$item['id']?>" ><label for="cbox" id="cbox"><?= $item['item_name'] ?></label><br>
    </tr>
    
    <?php endforeach?>
    

  </form> 

  <form action="shoppinglist.php" method="POST">
    <input type="text" name="item_name" id="item_name" class="hide">
    <button type = "button" onclick="createNewItem()">Add Item</button>
    <button type = "submit" class="hide">Save</button>
  </form><br>
  <a href="logout.php">Logout</a>
  <script>
    function createNewItem(){
      var text = document.getElementById("item_name");
      text.classList.toggle("hide");
      text.classList.toggle("show");
    }
    
  </script>
</body>
</html>
<?php
}else{
header("Location:login.php");
}?>