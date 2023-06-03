<?php include "header.php";
if( $_SESSION['role']=='0')
{
    header("Location: {$hostname}/admin/post.php");
   }

if(isset($_POST['submit'])){
    require_once("config.php");
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
   // $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);

  $query = "UPDATE `paper` set `fname`='$fname',`lname`='$lname',`username`='$username',`role`='$role' where `id`='$id'";

    // $result = mysqli_query($conn,$query) or die("result erreorr")
    
       if(mysqli_query($conn,$query)) {
        header("Location: {$hostname}/admin/users.php");
       }
    }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                    require_once("config.php");
                    $id = $_GET['id'];
                    
                $query = "SELECT * FROM paper where id='$id' ";
                $result  = mysqli_query($conn,$query) or die("result rrorr");
                if(mysqli_num_rows($result) > 0){ 
                while($row = mysqli_fetch_assoc($result)){

                    ?>
                  <!-- Form Start -->
                  <form  action=" <?Php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="id"   class="form-control" value="<?php echo $row['id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" value="<?php echo $row['fname']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" value="<?php echo $row['lname']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">  
                          <?php                
                              if( $row['role'] == 1){
                                  echo "<option value='0'>normal User</option>
                                  <option value='1' selected>Admin</option>";
                              }else{
                                  echo "<option value='0' selected>normal User</option>
                                  <option value='1'>Admin</option>";
                              }
                            ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
}
}
                  ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
