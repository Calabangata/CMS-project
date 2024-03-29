<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
<div class="col-md-8">


<?php

if(isset($_POST['create_post'])){

$post_title = mysqli_real_escape_string($connection, $_POST['title']);
$post_author = mysqli_real_escape_string($connection, $_POST['author']);
$post_category_id = $_POST['post_category'];
$post_image = $_FILES['image']['name'];//
$post_image_temp = $_FILES['image']['tmp_name'];//
$post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
$post_content = mysqli_real_escape_string($connection, $_POST['post_content']);

$post_date = date('d-m-y');



//$post_comment_count = 4;

(move_uploaded_file($post_image_temp, "images/$post_image"));

$query = "INSERT INTO  posts(id_post_category, post_title, post_author,
 post_date, post_image, post_content,
  post_tags, post_status)";

$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),
'{$post_image}','{$post_content}','{$post_tags}','draft')";

$send_post_query = mysqli_query($connection, $query);

confirmQuery($send_post_query);
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

<div class="form-group">
    <label for="title">Author</label>
    <input type="text" class="form-control" name="author">
</div>

<!-- <div class="form-group">
    <select name="post_status" id="post_status">
    <option value="draft">Post Status</option>
    <option value="draft">Draft</option>
    <option value="published">Published</option>
    </select>
</div> -->

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

</div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>



        </div> <!-- closing div is in navigation php -->
        <!-- /.row -->

        <hr>

       <?php
       include "includes/footer.php";
       ?>