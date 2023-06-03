<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $new_name = $_POST['old_image'];

}else{
 $error  = array();

    $file_name =  $_FILES['new-image']['name'];
    $file_size =  $_FILES['new-image']['size'];
    $file_tmp =  $_FILES['new-image']['tmp_name'];
    $file_type =  $_FILES['new-image']['type'];

    $file_ext = strtolower(end(explode('.',$file_name)));
    $ectiontions = array("jpeg","jpg","png");

    if(in_array($file_ext,$ectiontions) === false){
        $error[] = "THIS FILE NOT ALOUD, PLESS CHOSE JPG AND PNG FILESSSSS...";

    }
    if($file_size > 2097152){
        $error[] = "PLESS CHOSE THE 2MB SIZE"; 
    }
    if($file_size > 2097152){
        $error[] = "PLESS CHOSE THE 2MB SIZE"; 
    }
    $new_name = time()."-".basename($file_name);
    $target  = "upload/".$new_name;
    $img_name =  $new_name;

    if(empty($error) == true){
        move_uploaded_file($file_tmp,"admin/uplode/".$target);
    }else{
        print_r($error);
        die();
    }
}

  $query = "UPDATE post set `title` = '{$_POST["post_title"]}', `description`='{$_POST["postdesc"]}', `category`= {$_POST["category"]}, `post_img`='{$img_name}' 
            where  post_id ={$_POST["post_id"]};";
            if($_POST['old_category'] != $_POST['category']){
                $query .= "UPDATE category set post = post - 1 where category_id = {$_POST['old_category']};";
                $query .= "UPDATE category set post = post + 1 where category_id = {$_POST["category"]};
                
                ";
            }


    $result = mysqli_multi_query($conn,$query); 

    if($result){
            header("location: {$hostname}/admin/post.php");
    }else{
        echo "error";
    }

?>