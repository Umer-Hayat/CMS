<?php 

if (isset($_GET['p_id'])) {
	$update_post_id = escape($_GET['p_id']);

	$query = "SELECT * FROM posts WHERE post_id ={$update_post_id}";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_user = $row['post_user'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
        }
}



if (isset($_POST['update_post'])) {
	$post_title = escape($_POST['title']);
	$post_category_id = escape($_POST['post_category_id']);
	$post_user = escape($_POST['post_user']);
	$post_status = escape($_POST['post_status']);
	
	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];

	$post_tags = escape($_POST['post_tags']);
	$post_content = escape($_POST['post_content']);
	$post_date = date('d-m-y');

	move_uploaded_file($post_image_temp, "../images/$post_image");

	if (empty($post_image)) {
		$query = "SELECT * FROM posts WHERE post_id ={$update_post_id}";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
	}
	
	$query = "UPDATE posts SET ";
	$query .="post_title = '{$post_title}', ";
	$query .="post_category_id = {$post_category_id}, ";
	$query .="post_user = '{$post_user}', ";
	$query .="post_date = now(), ";
	$query .="post_image = '{$post_image}', ";
	$query .="post_content = '{$post_content}', ";
	$query .="post_tags = '{$post_tags}', ";
	$query .="post_status = '{$post_status}'";
	$query .="WHERE post_id = '{$update_post_id}'";

	$create_post_query = mysqli_query($connection, $query);
        confirm_Query($create_post_query);


    echo "Post Updated  <a href='../post.php?p_id={$update_post_id}'>View Post</a> or <a href='posts.php'>Edit other Post</a>";
}
 ?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" value="<?php echo $post_title; ?>" name="title">
	</div>
	<div class="form-group">
		<label for="title">Post Category</label><br>
		<select name="post_category_id" id="">
			<?php 
				$query = "SELECT * FROM categories";
		        $select_categories = mysqli_query($connection, $query);
		        confirm_Query($select_categories);
		        while ($row = mysqli_fetch_assoc($select_categories)) {
		            $cat_id = $row['cat_id'];
		            $cat_title = $row['cat_title'];
		            if ($cat_id == $post_category_id) {
		            	echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
		            }else{
		            	echo "<option value='{$cat_id}'>{$cat_title}</option>";

		            }
		            

		        }
		            ?>
		</select>
	</div>
	<div class="form-group">
		<label for="post_user">Post User</label><br />
		<select name="post_user" id="">
			<?php 
			echo "<option value='{$post_user}'>{$post_user}</option>";
			$query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            confirm_Query($select_users);
            while ($row = mysqli_fetch_assoc($select_users)) {
                $username = $row['username'];
                if($username != $post_user){
                	echo "<option value='{$username}'>{$username}</option>";
                }
		        
		    }
		            ?>
		</select>
	</div>
	<div class="form-group">
		<label for="post_status">Post Status</label><br>
		<select name="post_status" id="">
		<?php 
			echo "<option value={$post_status}>{$post_status}</option>";

			if ($post_status == "draft") {
				echo "<option value='poblished'>Poblished</option>";
			}else{
				echo "<option value='draft'>Draft</option>";
			}
		 ?>
		</select>
	</div>
	<div class="form-group">
		<?php echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";?> 
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" value="<?php echo $post_tags; ?>" name="post_tags">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" id="body" name="post_content" cols="30" rows="10"><?php echo str_replace('\r\n', '</br>', $post_content); ?></textarea>
		</script>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="update_post" value="Poblish Post" >
	</div>
</form>