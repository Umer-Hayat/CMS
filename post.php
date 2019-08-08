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

                        $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                        $view_query = mysqli_query($connection, $query);
                        if (!$view_query) {
                            die("QUERY FAILED".mysqli_error($connection));
                        }
                        
                        if ($_SESSION['user_role'] && $_SESSION['user_role'] == "Admin") {
                            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                        }else{
                            $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'poblished' " ;
                        }
                        $select_all_posts_query = mysqli_query($connection, $query);
                        if (mysqli_num_rows($select_all_posts_query)<1) {
                            echo "<h1 class='text-center'>No Post Available</h1>";
                        }else{
                        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_user = $row['post_user'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                        
                        ?>
                    <h1 class="page-header">
                        Post
                    </h1>
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_user; ?></a>
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
                
                <?php //create Comments

                    if (isset($_POST['create_comment'])) {

                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() )";
                            $insert_comment_query = mysqli_query($connection, $query);


                            // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            // $query .= "WHERE post_id = $the_post_id";
                            // $increment_comment_in_post = mysqli_query($connection, $query);
                        }else{
                        echo "<script>alert('Field cannot be empty');</script>";
                    }

                    }

                 ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Create Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 

                $query = "SELECT * FROM comments WHERE comment_post_id ={$the_post_id} ";
                $query .=" AND comment_status = 'Approved' ";
                $query .="ORDER BY comment_id DESC";
                $select_all_comments_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_comments_query)) {
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];
                    ?>
                           
                        
                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>


                <?php  
                }}}else{
                    header("Location: index.php");
                   }
                 ?>
                
            </div>

            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>

        
        <?php include "includes/footer.php" ?>