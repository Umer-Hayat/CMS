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

                        <?php 
                        if (isset($_GET['source'])) {
                            $source = escape($_GET['source']);
                        }
                        else
                            $source = "";
                        switch ($source) {
                            case 'post_comments':
                                include "includes/post_comments.php";
                                break;
                            default:
                                include "includes/view_all_comments.php";
                                break;
                        }

                        ?>
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