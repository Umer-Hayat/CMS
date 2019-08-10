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

                            if (isset($_SESSION['username'])) {
                                $username = $_SESSION['username'];

                                $query = "SELECT * FROM users WHERE username ='{$username}'";
                                    $select_users = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($select_users)) {
                                        $username = $row['username'];
                                        $user_password = $row['user_password'];
                                        $user_firstname = $row['user_firstname'];
                                        $user_image = $row['user_image'];
                                        $user_lastname = $row['user_lastname'];
                                        $user_email = $row['user_email'];
                                        $user_role = $row['user_role'];
                                    }
                            }


                            if (isset($_POST['update_profile'])) {
                                $username = escape($_POST['username']);
                                $user_password = escape($_POST['user_password']);
                                $user_firstname = escape($_POST['user_firstname']);
                                $user_lastname = escape($_POST['user_lastname']);

                                $user_image = $_FILES['image']['name'];
                                $user_image_temp = $_FILES['image']['tmp_name'];

                                $user_email = escape($_POST['user_email']);
                                $user_role = escape($_POST['user_role']);

                                move_uploaded_file($user_image_temp, "../images/$user_image");

                                if (empty($user_image)) {
                                    $query = "SELECT * FROM users WHERE username ='{$username}'";
                                    $select_image = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($select_image)) {
                                        $user_image = $row['user_image'];
                                    }
                                }
                                
                                $query = "UPDATE users SET ";
                                $query .="username = '{$username}', ";
                                $query .="user_password = '{$user_password}', ";
                                $query .="user_firstname = '{$user_firstname}', ";
                                $query .="user_lastname = '{$user_lastname}', ";
                                $query .="user_image = '{$user_image}', ";
                                $query .="user_email = '{$user_email}', ";
                                $query .="user_role = '{$user_role}' ";
                                
                                
                                $query .="WHERE username = '{$username}'";

                                $edit_user_query = mysqli_query($connection, $query);
                                    confirm_Query($edit_user_query);
                            }
                         ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="Password" class="form-control" value="<?php echo $username; ?>" name="user_password"<?php echo $username; ?>"">
                            </div>
                            <div class="form-group">
                                <label for="user_firstname">Firstname</label>
                                <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname">
                            </div>
                            <div class="form-group">
                                <label for="user_lastname">Lastname</label>
                                <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname">
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="text" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
                            </div>
                            <div class="form-group">
                                <?php echo "<td><img width='100' src='../images/$user_image' alt='image'></td>";?> 
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label for="user_role">Role</label><br>
                                <select name="user_role" id="">
                                <?php 
                                    echo "<option value={$user_role}>{$user_role}</option>";

                                    if ($user_role == "Admin") {
                                        echo "<option value='Subscriber'>Subscriber</option>";
                                    }else{
                                        echo "<option value='Admin'>Admin</option>";
                                    }
                                 ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile" >
                            </div>
                        </form>
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