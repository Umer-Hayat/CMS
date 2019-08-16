<?php 
    include("delete_modal.php");

if (isset($_POST['checkboxArray'])) {

    foreach ($_POST['checkboxArray'] as $checkbox_value) {
        
        $bulk_option = $_POST['bulk_option'];
        switch ($bulk_option) {
            case 'poblished':
                $query = "UPDATE posts SET ";
                $query .="post_status = '{$bulk_option}'";
                $query .="WHERE post_id = {$checkbox_value}";
                $create_post_query = mysqli_query($connection, $query);
                    confirm_Query($create_post_query);
                break;
            case 'draft':
                $query = "UPDATE posts SET ";
                $query .="post_status = '{$bulk_option}'";
                $query .="WHERE post_id = {$checkbox_value}";
                $create_post_query = mysqli_query($connection, $query);
                    confirm_Query($create_post_query);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$checkbox_value}";
                $delete_query = mysqli_query($connection, $query);
                confirm_query($delete_query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$checkbox_value}";
                $select_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $post_user = $row['post_user'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content=$row['post_content'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";

                $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_user}',now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";

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
                <option value="poblished">Poblish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" value="Apply" class="btn btn-success">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add now</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];
            ?>
            <tr>
                <td><input class="checkBoxes" type="checkbox" name="checkboxArray[]" value="<?php echo $post_id ?>"></td>

            <?php
                
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_user}</td>";
                echo "<td>{$post_title}</td>";
                //echo "<td>{$post_category_id}</td>";
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_categories = mysqli_query($connection, $query);
                confirm_Query($select_categories);
                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<td>{$cat_title}</td>";
                }
                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                echo "<td>{$post_tags}</td>";


                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $select_all_comments = mysqli_query($connection, $query);
                confirm_Query($select_all_comments);
                $comment_count = mysqli_num_rows($select_all_comments);

                echo "<td><a href='comments.php?source=post_comments&p_id={$post_id}'>{$comment_count}</a></td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                // echo "<td><a onClick=\" javascript: return confirm('Are you sure to Delete'); \" href='posts.php?post_delete={$post_id}'>Delete</a></td>";
                echo "<td><a rel='$post_id' class='delete_link' href='javascript:void(0)'>Delete</a></td>";
                echo "<td><a href='posts.php?post_views={$post_id}'>$post_views_count</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>
<?php 

if (isset($_GET['post_delete'])) {
    $delete_post_id = escape($_GET['post_delete']);

    $query = "DELETE FROM posts WHERE post_id = '$delete_post_id'";
    $delete_query = mysqli_query($connection, $query);
    confirm_query($delete_query);
    header("Location: posts.php");
}
if (isset($_GET['post_views'])) {
    $views_post_id =escape( $_GET['post_views']);

    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $views_post_id";
    $views_query = mysqli_query($connection, $query);
    confirm_query($views_query);
    header("Location: posts.php");
}
 ?>
 <script>
     
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            var id = $(this).attr("rel");
            var delete_url = "posts.php?post_delete=" + id + " ";
            $(".modal-delete-link").attr("href", delete_url);

            $("#myModal").modal('show');
        });
    });

 </script>