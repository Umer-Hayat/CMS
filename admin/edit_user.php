<?php 

if (isset($_GET['u_id'])) {
	$update_user_id = escape($_GET['u_id']);

	$query = "SELECT * FROM users WHERE user_id ={$update_user_id}";
        $select_users = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_users)) {
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_image = $row['user_image'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_randsalt = $row['user_randSalt'];
        }
}



if (isset($_POST['update_user'])) {
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
		$query = "SELECT * FROM users WHERE user_id ={$update_user_id}";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $user_image = $row['user_image'];
        }
	}
	if (!empty($user_password)) {
	
		$user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 12));
		
		$query = "UPDATE users SET ";
		$query .="username = '{$username}', ";
		$query .="user_password = '{$user_password}', ";
		$query .="user_firstname = '{$user_firstname}', ";
		$query .="user_lastname = '{$user_lastname}', ";
		$query .="user_image = '{$user_image}', ";
		$query .="user_email = '{$user_email}', ";
		$query .="user_role = '{$user_role}' ";
		
		
		$query .="WHERE user_id = '{$update_user_id}'";

		$edit_user_query = mysqli_query($connection, $query);
	    confirm_Query($edit_user_query);
	    header("Location: users.php");
    }else{
    	echo "Please Enter password";
    }
}
 ?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
	</div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="Password" class="form-control" name="user_password">
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
		<input type="submit" class="btn btn-primary" name="update_user" value="Update" >
	</div>
</form>