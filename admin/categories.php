<?php include "includes/header.php"; ?>
    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/Navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">
                            <?php  // Create Category
                            insert_category();
                            ?>
                            <!-- Add category form  -->
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" name="cat_title" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" name="submit" type="submit" value="Add Category">
                                </div>
                            </form>
                            <?php
                            if (isset($_GET['update'])) {
                                    $update_cat_id = escape($_GET['update']);
                                    include "includes/update_category.php";
                                }
                                ?>
                            
                            
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php // Show Record
                                    show_category();
                                 ?>
                                <?php delete_category(); ?>
                                 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/footer.php" ?>