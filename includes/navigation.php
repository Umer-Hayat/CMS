<?php include "includes/db.php" ?>
<?php session_start(); ?>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><strong>CMS Front</strong></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                        $query = "SELECT * FROM categories";
                        $select_all_categories_query = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            $category_class = '';
                            $registration_class = '';
                            $contact_class = '';

                            $pagename = basename($_SERVER['PHP_SELF']);

                            if (isset($_GET['category_id']) && $_GET['category_id'] == $cat_id) {
                                $category_class = 'active';
                            }elseif ($pagename == "registration.php") {
                                $registration_class = 'active';
                            }elseif ($pagename == "contact.php") {
                                $contact_class = 'active';
                            }

                            echo "<li class='$category_class'><a href='category.php?category_id={$cat_id}'>{$cat_title}</a></li>";
                        }
                        
                     ?>
                     <li>
                        <a href="admin">Admin</a>
                    </li>
                    <li class="<?php echo $registration_class; ?>">
                        <a href="registration.php">Register</a>
                    </li>
                    <li class="<?php echo $contact_class; ?>">
                        <a href="contact.php">contact</a>
                    </li>
                    <?php
                    if (isset($_SESSION['user_role'])) {
                            if (isset($_GET['p_id'])) {
                                $the_post_id = $_GET['p_id'];
                                echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
