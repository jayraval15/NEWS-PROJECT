<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
              <?php
            //    include "header.php";

                    if(isset($_POST['save'])){
                        
                        require_once("config.php");

                       $category_name = mysqli_real_escape_string($conn,$_POST['category_name']);
                      // $category_post = mysqli_real_escape_string($conn,$_POST['category_post']);
                    
                        $query = "SELECT * FROM category where `category_name` = '{$category_name}'";

                        $result = mysqli_query($conn,$query) or die("result erreorr");

                        if(mysqli_num_rows($result) > 0){
                            echo "<P> USER NAME OLREDY ples try agin </p>";
                        }else{
                            $sql = "INSERT INTO category (`category_name`) value ('{$category_name}')";

                           if(mysqli_query($conn,$sql)) {
                            // header("location: http://localhost/news-project/admin/user.php");
                            header("Location: {$hostname}/admin/category.php");
                           }
                        }

                    }

            ?>
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
                      </div> 
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
