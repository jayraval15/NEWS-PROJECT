<?php include "header.php";
if( $_SESSION['role']=='0')
{
    header("Location: {$hostname}/admin/post.php");
   }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">

              <?php
            //    include "header.php";

                    if(isset($_POST['save'])){
                        require_once("config.php");
                    
                        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
                        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                        $username = mysqli_real_escape_string($conn, $_POST['username']);
                        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                        $role = mysqli_real_escape_string($conn, $_POST['role']);

                        $query = "SELECT username FROM paper where `username` = '{$username}'";

                        $result = mysqli_query($conn,$query) or die("result erreorr");

                        if(mysqli_num_rows($result) > 0){
                            echo "<P> USER NAME OLREDY ples try agin </p>";
                        }else{
                            $sql = "INSERT INTO paper (`fname`,`lname`,`username`,`password`,`role`) value ('{$fname}','{$lname}','{$username}','{$password}','{$role}')";

                           if(mysqli_query($conn,$sql)) {
                            // header("location: http://localhost/news-project/admin/user.php");
                            header("Location: {$hostname}/admin/users.php");
                           }
                        }

                    }

            ?>
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
