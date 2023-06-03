<?php
include  "config.php";
if(isset($_FILES['fileToUpload'])){
    $error  = array();

    $file_name =  $_FILES['fileToUpload']['name'];
    $file_size =  $_FILES['fileToUpload']['size'];
    $file_tmp =  $_FILES['fileToUpload']['tmp_name'];
    $file_type =  $_FILES['fileToUpload']['type'];

    $file_ext = strtolower(end(explode('.',$file_name)));
    $ectiontions = array("jpeg","jpg","png");

    if(in_array($file_ext,$ectiontions) === false){
        $error[] = "THIS FILE NOT ALOUD, PLESS CHOSE JPG AND PNG FILESSSSS...";

    }
    if($file_size > 2097152){
        $error[] = "PLESS CHOSE THE 2MB SIZE"; 
    }
    if(empty($error) == true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        print_r($error);
        die();
    }
    
}
session_start();

$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$postdesc = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$date = date("d M,Y");
$author = $_SESSION['id'];

$query = "INSERT INTO post(`title`,`description`,`category`,`post_date`,`post_author`,`post_img`) value ('{$title}','{$postdesc}','{$category}','{$date}','{$author}','{$file_name}');";

$query .= "UPDATE category set category_post = category_post + 1   where category_id = '{$category}' ";

if(mysqli_multi_query($conn,$query)){
    header("location: {$hostname}/admin/post.php");
}else{
     echo "<div>QUERY FAILD</div>";
}
?>