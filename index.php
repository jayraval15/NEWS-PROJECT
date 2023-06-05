<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <?php
                            include "config.php";

                            $limit = 3;
                                    

                            if(isset($_GET['page'])){
                                $page = $_GET['page'];
                            }else{
                                $page = 1;
                            }
                            $ofset = ($page - 1) * $limit;

                       $query = "SELECT post.post_id, post.title, post.description, post.post_date, category.category_name, paper.username, post.category, post.post_img, post.post_author FROM  post
                            LEFT JOIN category on post.category = category.category_id
                            LEFT JOIN paper on post.post_author = paper.id
                            ORDER BY post.post_id desc limit {$ofset},{$limit}";

                        $result  = mysqli_query($conn,$query) or die("result rrorr");

                        if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_assoc($result)){
                        ?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single?id=<?php echo $row['post_id']; ?>.php"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['post_author']; ?>'><?php echo $row['username']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo substr($row['post_date'],0,130) ."..."; ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo $row['description']; ?> 
                                      </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }else{
                        echo "<h2>NO RECOD FOUND</h2>"; 
                    }
 $sqli = "SELECT * FROM post ";
 $result1 = mysqli_query($conn,$sqli); 
                         if(mysqli_num_rows($result1)>0){
         $tottle_recode = mysqli_num_rows($result1);
        
         $tottle_page = $tottle_recode / $limit;
         echo "<ul class='pagination admin-pagination'>";

         if($page > 1){

             echo "<li><a href='index.php?page=".($page - 1)."'>last</a></li>";
         }
             for($i = 1; $i <= $tottle_page; $i++){
             if($i == $page){
                     $activ = "active";
             }else{
                 $activ = "";
             }
            echo " <li class='".$activ."' ><a href='index.php?page=".$i."'>".$i."</a></li>";
         }
         
         if($tottle_page > $page){

             echo "<li><a href='index.php?page=".($page + 1)."'>Next</a></li>";
         }
        
         echo "</ul>";
     }
                       ?>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
