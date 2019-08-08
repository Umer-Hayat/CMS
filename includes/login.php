<?php include "db.php"; ?>
<?php session_start(); ?>
<?php 

if (isset($_POST['login_btn'])) {
	$login_username = $_POST['login_username'];
	$login_password = $_POST['login_password'];


	$login_username =mysqli_real_escape_string($connection, $login_username);
	$login_password =mysqli_real_escape_string($connection, $login_password);

	$query = "SELECT * FROM users WHERE username = '{$login_username}'";
        $select_users_query = mysqli_query($connection, $query);

        if (!$select_users_query) {
        	die("QUERY FAILED".mysqli_error($connection));
        }
         while ($row = mysqli_fetch_assoc($select_users_query)) {
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
        }

        //$login_password = crypt($login_password, $db_user_password);

        if (password_verify($login_password, $db_user_password)) {
        	$_SESSION['username'] = $db_username;
        	$_SESSION['firstname'] = $db_user_firstname;
        	$_SESSION['lastname'] = $db_user_lastname;
        	$_SESSION['user_role'] = $db_user_role;
        	header("Location: ../admin/index.php");
        }else{
            header("Location: ../index.php");
        }
}

 ?>
