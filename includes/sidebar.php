<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <?php if(isset($_SESSION['username'])): ?>

                    <div class="well">
                        <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
                        <a href="includes/logout.php" class="btn btn-primary">Log Out</a>
                    </div>

                <?php else: ?>

                    <div class="well">
                        <h4>Login</h4>
                        <form action="includes/login.php" method="post">
                            <div class="form-group">
                                <input name="login_username" type="text" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <input name="login_password" type="Password" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <input name="login_btn" type="submit" value="Login" class="btn btn-primary">
                            </div>
                        </form>
                        <!-- /.input-group -->
                    </div>
                    
                <?php endif; ?>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 
                                    $query = "SELECT * FROM categories";
                                    $select_categories_sidebar = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<li><a href='category.php?category_id={$cat_id}'>{$cat_title}</a></li>";
                                    }
                                 ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <!-- <?php //include "wedget.php"; ?> -->
            </div>
