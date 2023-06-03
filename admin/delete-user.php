<?php


require_once("config.php");
if( $_SESSION['role']=='0')
{
    header("Location: {$hostname}/admin/post.php");
   }

$id = $_GET['id'];

 $query = "DELETE  FROM  `paper` where  `id`='$id'";
 
 if(mysqli_query($conn,$query)){

    header("Location: {$hostname}/admin/users.php");
 }else{
    echo "<p> cont delete thise user";
 } 
 mysqli_close($conn);
?>