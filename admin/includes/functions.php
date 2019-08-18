<?php 

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}


function users_online(){

    if (isset($_GET['onlineusers'])) {
        global $connection;
        if (!$connection) {
            session_start();
            include("../includes/db.php");
            
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM user_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                
                mysqli_query($connection, "INSERT INTO user_online(session, time) VALUES ('$session', '$time')");
            }else{
                mysqli_query($connection, "UPDATE user_online SET time = '$time' WHERE session = '$session'");
            }

            $query = "SELECT * FROM user_online WHERE time > '$time_out' ";
            $user_online_query = mysqli_query($connection, $query);
            echo $count_user = mysqli_num_rows($user_online_query);
        }
    }
}
users_online();

function confirm_Query($query){
    global $connection;
    if (!$query) {
        die("Query Failed".mysqli_error($connection));
    }
}

function insert_category()
{
	global $connection;
	if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be Empty";
        }else{
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);
            confirm_Query($create_category_query);
        }
    }

}
function show_category()
{
	global $connection;
	$query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?update={$cat_id}'>Update</a></td>";
            echo "</tr>";
        }
}
function delete_category()
{ // Delete Record
	global $connection;
    if (isset($_GET['delete'])) {
        $delete_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = '$delete_cat_id'";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
 ?>