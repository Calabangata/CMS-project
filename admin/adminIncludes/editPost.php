<?php

if(isset($_GET['p_id'])){

$postID = $_GET['p_id'];

}

$query = "SELECT * FROM posts WHERE id_post = $postID";
$select_posts_by_id = mysqli_query($connection, $query);


while($row = mysqli_fetch_assoc($select_posts_by_id)){
$post_id = $row['id_post'];
$post_author = $row['post_author'];
$post_title = $row['post_title'];
$post_cat_id = $row['id_post_category'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_content = $row['post_content'];
$post_tags = $row['post_tags'];
$post_comment_count = $row['post_comment_count'];
$post_date = $row['post_date'];

}

if(isset($_POST['update_post'])){
    $post_author = mysqli_real_escape_string($connection, $_POST['author']);
    $post_title = mysqli_real_escape_string($connection, $_POST['title']);
    $post_category_id = $_POST['post_category'];
    $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
    $post_image = $_FILES['image']['name'];//
    $post_image_temp = $_FILES['image']['tmp_name'];//
    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    //$post_content = $_POST['post_content'];
    

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE id_post = $postID";
        $select_image = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }

    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "id_post_category = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE id_post = {$postID} ";

    

    $update_post = mysqli_query($connection, $query);

    confirmQuery($update_post);

    echo "<p class = 'bg-success'>Post updated! <a href = '../post.php?p_id={$postID}'>View post</a> or <a href = 'Posts.php'>Edit more posts!</a> </p>";
    
}

?>

<form action="" method = "post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
</div>

<div class="form-group">
   <select name="post_category" id="post_category">

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
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
</div>

<div class="form-group">
<select name="post_status" id="">


<option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>

<?php
if($post_status == 'published'){
    echo "<option value='draft'>Draft</option>";
} else {
    echo "<option value='published'>Publish</option>";
}
?>

</select>
    </div>

<div class="form-group">
    <img width="100" src="../images/<?php echo $post_image;?>" alt="">
    <input type="file" name="image">
</div>

<div class="form-group">
    <label for="post_tags">Post tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea  class="form-control" name="post_content" id="summernote" cols="30" rows="10" ><?php echo $post_content; ?></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit"  name="update_post" value="Update Post">
</div>

</form>

