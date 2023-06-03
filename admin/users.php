<?php include "header.php";
if( $_SESSION['role']=='0')
{
    header("Location: {$hostname}/admin/post.php");
   } 
     ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-3">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php  
                require_once("config.php");
                $limit = 3;
           

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }
            $ofset = ($page - 1) * $limit;

                $query = "SELECT * FROM paper ORDER BY id desc limit {$ofset},{$limit}";
                $result  = mysqli_query($conn,$query) or die("result rrorr");

                if(mysqli_num_rows($result) > 0){
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php  
                         $sr = 1;       
                        while($row = mysqli_fetch_assoc($result)){
                           
                        ?>
                          <tr>
                              <td class='id'><?php echo $sr++ ?> </td>
                              <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
                              <td><?php echo $row['username']; ?> </td>
                              <td>
                                <?php
                              
                            if( $row['role'] == 1){
                                echo "admin";
                            }else{
                                echo "norml";
                            }
                              ?>
                              </td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row["id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row["id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                            }
                          ?>
                      </tbody>
                  </table>
                  <?php
                }
                $sqli = "SELECT * FROM paper ";
                $result1 = mysqli_query($conn,$sqli); 
                                        if(mysqli_num_rows($result1)>0){
                        $tottle_recode = mysqli_num_rows($result1);
                       
                        $tottle_page = $tottle_recode / $limit;
                        echo "<ul class='pagination admin-pagination'>";

                        if($page > 1){
  
                            echo "<li><a href='users.php?page=".($page - 1)."'>last</a></li>";
                        }
                            for($i = 1; $i <= $tottle_page; $i++){
                            if($i == $page){
                                    $activ = "active";
                            }else{
                                $activ = "";
                            }
                           echo " <li class='".$activ."' ><a href='users.php?page=".$i."'>".$i."</a></li>";
                        }
                        
                        if($tottle_page > $page){
  
                            echo "<li><a href='users.php?page=".($page + 1)."'>Next</a></li>";
                        }
                       
                        echo "</ul>";
                    }
                  ?>
                 
                      <!-- <li class="active"><a>1</a></li>
                      -->
                 
                 
              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
