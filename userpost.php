<?php include "includes/header.php" ?>

    

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                if (isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id'];
                    $the_post_user = $_GET['p_user'];
                }
                        $query = "SELECT * FROM posts WHERE post_user = '{$the_post_user}' ";
                        $select_all_posts_query = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_user = $row['post_user'];
                            $post_user = $row['post_user'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                        
                        ?>
                <h1 class="page-header">
                    Posts
                </h1>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="userpost.php?p_user=<?php echo $post_user;?>&p_id=<?php echo $post_id;?>"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id;?>">
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <!-- 
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>
                 <?php } ?>
            </div>

            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>

        
        <?php include "includes/footer.php" ?>