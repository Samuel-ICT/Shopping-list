<?php
include "database.php";

if(empty($_POST['cbox'])){
            
   $_POST['cbox'] = null;
   header("Location:shoppinglist.php");
   exit;
}


if(isset($_POST['delete'])){
    $all_id = $_POST['cbox'];
    $extract_id = implode(',', $all_id);
    echo $extract_id;

    $stmt = $db_conn->prepare("DELETE FROM items WHERE id  IN  ($extract_id)");

    $stmt->execute();

    if($stmt){
        header('Location:shoppinglist.php');
    }
    
}
?>