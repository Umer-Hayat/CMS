<?php 

if (isset($_POST['create_post'])) {
	$post_title = escape($_POST['title']);
	$post_category_id = escape($_POST['post_category_id']);
	$post_user = escape($_POST['post_user']);
	$post_status = escape($_POST['post_status']);
	
	$post_image = escape($_FILES['image']['name']);
	$post_image_temp = $_FILES['image']['tmp_name'];

	$post_tags = escape($_POST['post_tags']);
	$post_content = escape($_POST['post_content']);
	$post_date = date('d-m-y');

	move_uploaded_file($post_image_temp, "../images/$post_image");

	$query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";

	$query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_user}',now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

	$create_post_query = mysqli_query($connection, $query);
        confirm_Query($create_post_query);

    $the_post_id = mysqli_insert_id($connection);

	

echo "Post Created  <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='./posts.php'>Edit other Post</a>";
}

?>


<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title">
	</div>
	<div class="form-group">
		<label for="post_category_id">Post Category</label><br />
		<select name="post_category_id" id="">
			<?php 
				$query = "SELECT * FROM categories";
		        $select_categories = mysqli_query($connection, $query);
		        confirm_Query($select_categories);
		        while ($row = mysqli_fetch_assoc($select_categories)) {
		            $cat_id = $row['cat_id'];
		            $cat_title = $row['cat_title'];
		            echo "<option value='{$cat_id}'>{$cat_title}</option>";
		        }
		            ?>
		</select>
	</div>
	<div class="form-group">
		<label for="post_user">Post User</label><br />
		<select name="post_user" id="">
			<?php 
			$query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            confirm_Query($select_users);
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo "<option value='{$username}'>{$username}</option>";
		        }
		            ?>
		</select>
	</div>
	<!-- <div class="form-group">
		<label for="post_user">Post Author</label>
		<input type="text" class="form-control" name="post_user">
	</div> -->
	<div class="form-group">
		<label for="post_status">Post Status</label><br>
		<select class="input-control" name="post_status" id="">
			<option value="draft">Select Option</option>
			<option value="draft">Draft</option>
			<option value="poblished">Poblished</option>
		</select>
	</div>
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" id="body" name="post_content" cols="30" rows="10"></textarea>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_post" value="Poblish Post" >
	</div>
</form>