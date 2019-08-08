<?php include "includes/header.php" ?>

    

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            
                
                
                <?php 
                        if (isset($_GET['category_id'])) {
                            $the_cat_id= $_GET['category_id'];
                        if ($_SESSION['user_role'] && $_SESSION['user_role'] == "Admin") {
                            $query = "SELECT * FROM posts WHERE post_category_id = $the_cat_id ";
                        }else{
                            $query = "SELECT * FROM posts WHERE post_category_id = $the_cat_id AND post_status = 'poblished' ";
                        }
                        $select_all_posts_query = mysqli_query($connection, $query);
                        if (mysqli_num_rows($select_all_posts_query)<1) {
                            echo "<h1 class='text-center'>No Post Available</h1>";
                        }else{
                            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_user = $row['post_user'];
                                $post_user = $row['post_user'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = substr($row['post_content'], 0, 100);
                            
                            ?>
                            <h1 class="page-header">
                                Posts
                            </h1>
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_user; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                <?php 
                } }
                }else{
                    header("Location:index.php"); 
                }

                ?>


                <!-- First Blog Post -->
                
            </div>

            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>

        
        <?php include "includes/footer.php" ?>