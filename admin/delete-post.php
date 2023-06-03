<?php
include "config.php";
$post_id = $_GET['id'];

$sql = "SELECT * FROM post where post_id = {$post_id}"; 
$result = mysqli_query($conn,$sql) or die("36386");

$row = mysqli_fetch_assoc($result);

unlink("upload/".$row['post_img']);

$cat_id = $_GET['catid'];

$query = "DELETE FROM post where post_id = {$post_id}"; 
//$query .= "UPDATE category set post = post - 1 where category_id = {$cat_id}";

if(mysqli_multi_query($conn,$query)){
    header("location: {$hostname}/admin/post.php");
}else{
    echo "Error: ";
}

?>