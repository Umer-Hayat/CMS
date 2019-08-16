<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Responce To</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php  
        $query = "SELECT * FROM comments WHERE comment_post_id = ".mysqli_real_escape_string($connection, $_GET['p_id']);
        $select_all_comments = mysqli_query($connection, $query);
        confirm_Query($select_all_comments);
        while ($row = mysqli_fetch_assoc($select_all_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";
            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
            $select_post = mysqli_query($connection, $query);
            confirm_Query($select_post);
            while ($row = mysqli_fetch_assoc($select_post)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
            }
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?comment_approve={$comment_id}&source=post_comments&p_id=".$_GET['p_id']."'>Approve</a></td>";
            echo "<td><a href='comments.php?comment_unapprove={$comment_id}&source=post_comments&p_id=".$_GET['p_id']."'>Unapprove</a></td>";
            echo "<td><a onClick=\" javascript: return confirm('Are you sure to Delete'); \" href='comments.php?comment_delete={$comment_id}&source=post_comments&p_id=".$_GET['p_id']."'>Delete</a></td>";
            
            echo "</tr>";
        }
        ?>
    </tbody>
    </table>

    <?php //Approve Comments

    if (isset($_GET['comment_approve'])) {
    $approve_comment_id = $_GET['comment_approve'];

    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = '$approve_comment_id'";
    $approve_comment_query = mysqli_query($connection, $query);
    confirm_query($approve_comment_query);
    header("Location: comments.php?source=post_comments&p_id=".$_GET['p_id']."");
    }
    ?>

    
    <?php //Unapprove Comments

    if (isset($_GET['comment_unapprove'])) {
    $unapprove_comment_id = $_GET['comment_unapprove'];

    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = '$unapprove_comment_id'";
    $delete_query = mysqli_query($connection, $query);
    confirm_query($delete_query);
    header("Location: comments.php?source=post_comments&p_id=".$_GET['p_id']."");
    }
    ?>

    <?php //Delete Comments

    if (isset($_GET['comment_delete'])) {
    $delete_comment_id = $_GET['comment_delete'];

    $query = "DELETE FROM comments WHERE comment_id = '$delete_comment_id'";
    $delete_query = mysqli_query($connection, $query);
    confirm_query($delete_query);
    header("Location: comments.php?source=post_comments&p_id=".$_GET['p_id']."");
    }
    ?>