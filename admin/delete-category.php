<?php


require_once("config.php");
if( $_SESSION['role']=='0')
{
    header("Location: {$hostname}/admin/post.php");
   }

$id = $_GET['category_id'];

 $query = "DELETE  FROM  `category` where  `category_id`='$id'";
 
 if(mysqli_query($conn,$query)){

    header("Location: {$hostname}/admin/category.php");
 }else{
    echo "<p> cont delete thise user";
 } 
 mysqli_close($conn);
?>