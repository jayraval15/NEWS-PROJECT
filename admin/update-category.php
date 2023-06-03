<?php include "header.php";
if( $_SESSION['role']=='0')
{
    header("Location: {$hostname}/admin/post.php");
   
}
if(isset($_POST['sumbit'])){

    require_once("config.php");
    $id = $_POST['category_id'];
    $catgname= mysqli_real_escape_string($conn, $_POST['catgname']);
  $query = "UPDATE `category` set `category_name`='{$catgname}' where `category_id`='$id'";

    // $result = mysqli_query($conn,$query) or die("result erreorr")
    
       if(mysqli_query($conn,$query)) {
        header("Location: {$hostname}/admin/category.php");
       }
    }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
                    require_once("config.php");
                    $id = $_GET['category_id'];
                    
                $query = "SELECT * FROM category where `category_id`='$id' ";
                $result  = mysqli_query($conn,$query) or die("result rrorr");
                if(mysqli_num_rows($result) > 0){ 
                while($row = mysqli_fetch_assoc($result)){

                    ?>
                  <form action="<?Php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="category_id"  class="form-control" value="<?php echo $row['category_id']; ?>">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="catgname" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
}
}
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
