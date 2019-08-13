<?php 

if (isset($_POST['add_user'])) {
	$username = escape($_POST['username']);
	$user_password = escape($_POST['user_password']);
	$user_firstname = escape($_POST['user_firstname']);
	$user_lastname = escape($_POST['user_lastname']);
	
	$user_image = escape($_FILES['image']['name']);
	$user_image_temp = $_FILES['image']['tmp_name'];

	$user_email = escape($_POST['user_email']);
	$user_role =escape($_POST['user_role']);

	// $query = "SELECT user_randSalt FROM users";
 //            $select_randsalt_query = mysqli_query($connection, $query);
 //            if (!$select_randsalt_query) {
 //                die("QUERY FAILED ".mysqli_error($connection));
 //            }
 //            $row = mysqli_fetch_array($select_randsalt_query);
 //            $randsalt = $row['user_randSalt'];
 //            $user_password = crypt($user_password, $randsalt);
	$user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 12));

	move_uploaded_file($user_image_temp, "../images/$user_image");

	$query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_image, user_role, user_email) ";

	$query .= "VALUES ('{$username}', '{$user_password}', '{$user_firstname}','{$user_lastname}', '{$user_image}', '{$user_role}', '{$user_email}')";

	$create_user_query = mysqli_query($connection, $query);
        confirm_Query($create_user_query);


echo "User Created  " . "<a href='users.php'>View User</a>";
}
?>


<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username">
	</div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="Password" class="form-control" name="user_password">
	</div>
	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>
	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="text" class="form-control" name="user_email">
	</div>
	<div class="form-group">
		<label for="user_image">User Image</label>
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<label for="user_role">Role</label><br>
		<select name="user_role" id="">
			<option value="subscriber">Select Option</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="add_user" value="Add User" >
	</div>
</form>