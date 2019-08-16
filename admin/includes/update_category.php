<?php

    $query = "SELECT * FROM categories WHERE cat_id = '$update_cat_id' ";
    $select_categories = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($select_categories);
    $cat_title = $row['cat_title'];
?>
	    <!-- Update category form  -->
	<form action="" method="post">
	    <div class="form-group">
	        <label for="cat_title">Edit Category</label>
	        <input class="form-control" value="<?php if (isset($cat_title)) {echo $cat_title;} ?>" name="update_cat_title" type="text">
	    </div>
	    <div class="form-group">
	        <input class="btn btn-primary" name="update_btn" type="submit" value="Update Category">
	    </div>
	</form>

	<?php  //Update Record
	    if (isset($_POST['update_btn'])) {
	        $cat_title = escape($_POST['update_cat_title']);
	    if ($cat_title == "" || empty($cat_title)) {
	        echo "This field should not be Empty";
	    }else{
	        $query = "UPDATE categories SET ";
	        $query .= "cat_title = '$cat_title' WHERE cat_id = '$update_cat_id'";
	        $create_category_query = mysqli_query($connection, $query);
	        if (!$create_category_query) {
	            die("Query Failed".mysqli_error($connection));
	        }
	        header("Location: categories.php");
	    }
	    }
	?>