<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
              <?php  
                require_once("config.php");
                $limit = 3;
           

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }
            $ofset = ($page - 1) * $limit;

            if($_SESSION["role"]=='1')             
                {
                    $query = "SELECT * FROM  post
                    LEFT JOIN category on post.category = category.category_id
                    LEFT JOIN paper on post.post_author = paper.id
                    ORDER BY post.post_id desc limit {$ofset},{$limit}";
                    } elseif($_SESSION["role"]=='0'){
                        $query = "SELECT * FROM post
                    LEFT JOIN category on post.category = category.category_id
                    LEFT JOIN paper on post.post_author = paper.id
                    where post.post_author = {$_SESSION['id']}
                    ORDER BY post.post_id desc limit {$ofset},{$limit}";

                    }
                          $result  = mysqli_query($conn,$query) or die("result rrorr");

                if(mysqli_num_rows($result) > 0){
                
               ?>
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php  
                         $sr = 1;       
                        while($row = mysqli_fetch_assoc($result)){
                           
                        ?>
                          <tr>
                              <td class='id'><?php echo $sr++ ?></td>
                              <td><?php echo $row['title']; ?> </td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; ?>&catid=<?php echo $row['category']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                  <?php
                }
                $sqli = "SELECT * FROM post ";
                $result1 = mysqli_query($conn,$sqli); 
                                        if(mysqli_num_rows($result1)>0){
                        $tottle_recode = mysqli_num_rows($result1);
                       
                        $tottle_page = $tottle_recode / $limit;
                        echo "<ul class='pagination admin-pagination'>";

                        if($page > 1){
  
                            echo "<li><a href='post.php?page=".($page - 1)."'>last</a></li>";
                        }
                            for($i = 1; $i <= $tottle_page; $i++){
                            if($i == $page){
                                    $activ = "active";
                            }else{
                                $activ = "";
                            }
                           echo " <li class='".$activ."' ><a href='post.php?page=".$i."'>".$i."</a></li>";
                        }
                        
                        if($tottle_page > $page){
  
                            echo "<li><a href='post.php?page=".($page + 1)."'>Next</a></li>";
                        }
                       
                        echo "</ul>";
                    }
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
