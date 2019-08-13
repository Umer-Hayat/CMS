<?php 

if (isset($_POST['checkboxArray'])) {

    foreach ($_POST['checkboxArray'] as $checkbox_value) {
        
        $bulk_option = $_POST['bulk_option'];
        switch ($bulk_option) {
            case 'admin':
                $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = '$checkbox_value' ";
                    $subsc_query = mysqli_query($connection, $query);
                    confirm_query($subsc_query);
                    header("Location: users.php");
                break;
            case 'subscriber':
                $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$checkbox_value}";
                    $subsc_query = mysqli_query($connection, $query);
                    confirm_query($subsc_query);
                    header("Location: users.php");
                break;
            case 'delete':
                $query = "DELETE FROM users WHERE user_id = {$checkbox_value}";
                $delete_query = mysqli_query($connection, $query);
                confirm_query($delete_query);
                header("Location: users.php");
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$checkbox_value}";
                $select_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content=$row['post_content'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";

                $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}',now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";

                $create_post_query = mysqli_query($connection, $query);
                    confirm_Query($create_post_query);
                break;
                    
        }
    }
}

 ?>


<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div class="col-xs-4"  style="padding: 0px;" id="bulkoptioncontainer">
            <select name="bulk_option" class="form-control">
                <option value="">Select Option</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" value="Apply" class="btn btn-success">
            <a href="users.php?source=add_user" class="btn btn-primary">Add now</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Image</th>
                <th>Role</th>
                <th>Admin</th>
                <th>Subscriber</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
            ?>
            <tr>
                    <td><input class="checkBoxes" type="checkbox" name="checkboxArray[]" value="<?php echo $user_id ?>"></td>
            <?php
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$user_password}</td>";
                echo "<td>{$user_firstname}</td>";
                echo "<td>{$user_lastname}</td>";
                // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                // $select_categories = mysqli_query($connection, $query);
                // confirm_Query($select_categories);
                // while ($row = mysqli_fetch_assoc($select_categories)) {
                //     $cat_id = $row['cat_id'];
                //     $cat_title = $row['cat_title'];
                //     echo "<td>{$cat_title}</td>";
                // }
                echo "<td>{$user_email}</td>";
                echo "<td><img width='100' src='../images/$user_image' alt='image'></td>";
                echo "<td>{$user_role}</td>";
                echo "<td><a href='users.php?admin_role={$user_id}'>Admin</a></td>";
                echo "<td><a href='users.php?subscriber_role={$user_id}'>Subscriber</a></td>";
                echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
                echo "<td><a onClick=\" javascript: return confirm('Are you sure to Delete'); \" href='users.php?user_delete={$user_id}'>Delete</a></td>";

                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>

    <?php //Admin role

    if (isset($_GET['admin_role'])) {
    $admin_user_id = escape($_GET['admin_role']);

    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = '$admin_user_id'";
    $delete_query = mysqli_query($connection, $query);
    confirm_query($delete_query);
    header("Location: users.php");
    }
    ?>

    
    <?php //Subscriber role

    if (isset($_GET['subscriber_role'])) {
    $sub_user_id = escape($_GET['subscriber_role']);

    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = '$sub_user_id'";
    $delete_query = mysqli_query($connection, $query);
    confirm_query($delete_query);
    header("Location: users.php");
    }
    ?>



<?php 

if (isset($_GET['user_delete'])) {
    if(isset($_SESSION['user_role']))
    {
        if ($_SESSION['user_role'] == 'admin') {
            $delete_user_id = escape($_GET['user_delete']);
            $query = "DELETE FROM users WHERE user_id = '$delete_user_id'";
            $delete_query = mysqli_query($connection, $query);
            confirm_query($delete_query);
            header("Location: users.php");
        }
    }
}
 ?>