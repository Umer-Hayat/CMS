<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/Navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome <?php echo $_SESSION['username']; ?>
                            <!-- <small><?php //echo $_SESSION['username']; ?></small> -->
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                       
                <!-- /.row -->
<?php 

$query = "SELECT * FROM posts";
$select_all_posts=mysqli_query($connection, $query);
$post_cout = mysqli_num_rows($select_all_posts);


$query = "SELECT * FROM comments";
$select_all_comments=mysqli_query($connection, $query);
$comment_cout = mysqli_num_rows($select_all_comments);


$query = "SELECT * FROM users";
$select_all_users=mysqli_query($connection, $query);
$user_cout = mysqli_num_rows($select_all_users);


$query = "SELECT * FROM categories";
$select_all_categories=mysqli_query($connection, $query);
$category_cout = mysqli_num_rows($select_all_categories);

 ?>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $post_cout ;?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'><?php echo $comment_cout ;?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $user_cout ;?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $category_cout ;?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
<?php 

$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_posts=mysqli_query($connection, $query);
$draft_post_cout = mysqli_num_rows($select_all_draft_posts);


$query = "SELECT * FROM posts WHERE post_status = 'poblished'";
$select_all_poblished_posts=mysqli_query($connection, $query);
$poblished_post_cout = mysqli_num_rows($select_all_poblished_posts);


$query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$select_all_unapproved_comments=mysqli_query($connection, $query);
$unapproved_comment_cout = mysqli_num_rows($select_all_unapproved_comments);


$query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
$select_all_subscriber_users=mysqli_query($connection, $query);
$subscriber_user_cout = mysqli_num_rows($select_all_subscriber_users);


// $query = "SELECT * FROM categories";
// $select_all_categories=mysqli_query($connection, $query);
// $category_cout = mysqli_num_rows($select_all_categories);

 ?>


                <div class="row">
                    
                    <script type="text/javascript">
                          google.charts.load('current', {'packages':['bar']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                              ['Data', 'Count'],
                              <?php 
                              $element_text = ['Total Posts', 'Poblished Posts', 'Draft Posts', 'Comments', 'Unapproeved Comments', 'Users', 'Subscribers', 'Categories'];
                              $element_count = [$post_cout, $poblished_post_cout, $draft_post_cout, $comment_cout, $unapproved_comment_cout, $user_cout, $subscriber_user_cout, $category_cout];

                              for ($i = 0; $i < 8; $i++) {
                                  echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                              }
                              
                               ?>
                              // ['2017', 1030],
                            ]);

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                          }
                    </script>
                    <div id="columnchart_material" style="width: auto; height: 450px;"></div>


                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/footer.php" ?>