<?php

if(isset($_POST['create_post'])){

// $post_title = $_POST['title'];
// $post_author = $_POST['author'];
// $post_category_id = $_POST['post_category'];
// $post_status = $_POST['post_status'];

// $post_image = $_FILES['image']['name'];
// $post_image_temp = $_FILES['image']['tmp_name'];

// $post_tags = $_POST['post_tags'];
// $post_content = $_POST['post_content'];
$post_title = mysqli_real_escape_string($connection, $_POST['title']);

if($_SESSION['userRole'] != "Admin"){
    $post_author = mysqli_real_escape_string($connection, $_SESSION['username']);
    $post_status = "draft";
} else {
    $post_author = mysqli_real_escape_string($connection, $_POST['author']);
    $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
}


$post_category_id = $_POST['post_category'];
$post_image = $_FILES['image']['name'];//
$post_image_temp = $_FILES['image']['tmp_name'];//
$post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
$post_content = mysqli_real_escape_string($connection, $_POST['post_content']);

$post_date = date('d-m-y');



//$post_comment_count = 4;

(move_uploaded_file($post_image_temp, "../images/$post_image"));

$query = "INSERT INTO  posts(id_post_category, post_title, post_author,
 post_date, post_image, post_content,
  post_tags, post_status)";

$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),
'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

$send_post_query = mysqli_query($connection, $query);

confirmQuery($send_post_query);

$postID = mysqli_insert_id($connection);

echo "<p class = 'bg-success'>Post created! <a href = '../post.php?p_id={$postID}'>View post</a> or <a href = 'Posts.php'>View more posts!</a> </p>";

}


?>

<form action="" method = "post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
</div>

<div class="form-group">
   <select name="post_category" id="post_category">

   <option value="">Post Category</option>
    <?php
    
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    confirmQuery($select_categories);

        while($row = mysqli_fetch_assoc($select_categories)){
        $id_cat = $row['id_cat'];
        $cat_title = $row['cat_title'];

            echo "<option value='{$id_cat}'>{$cat_title}</option>";

        }
    
    ?>
    

   </select>
</div>

<?php
if($_SESSION['userRole'] == "Admin"){
    echo '<div class="form-group">
    <label for="title">Author</label>
    <input type="text" class="form-control" name="author">
</div>

<div class="form-group">
    <select name="post_status" id="post_status">
    <option value="draft">Post Status</option>
    <option value="draft">Draft</option>
    <option value="published">Published</option>
    </select>
</div>';
}


?>

<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
</div>

<div class="form-group">
    <label for="post_tags">Post tags</label>
    <input type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10" ></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit"  name="create_post" value="Publish Post">
</div>


</form>