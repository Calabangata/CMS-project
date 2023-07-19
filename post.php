<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<link href="css/style.css" rel="stylesheet">
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

        <div class="col-md-8">
            

            <?php

            if(isset($_GET['p_id'])){
                $that_post_id = $_GET['p_id'];
            
                $viewsQuery = "UPDATE posts SET post_views = post_views + 1 WHERE id_post = $that_post_id";
                $sendQuery = mysqli_query($connection, $viewsQuery);
                confirmQuery($sendQuery);

                if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin'){
                    $query = "SELECT * FROM posts WHERE id_post = $that_post_id ";
                } else {
                    $query = "SELECT * FROM posts WHERE id_post = $that_post_id AND post_status = 'published'";
                }
            
            
            $select_all_posts_query = mysqli_query($connection, $query);

            if(mysqli_num_rows($select_all_posts_query) < 1){
                echo "<img class='img-responsive margins' src='images/NoResultsFound.png'>";
            
            } else {

                while($row = mysqli_fetch_assoc($select_all_posts_query)){

                   $post_title = $row['post_title'];
                   $post_author = $row['post_author'];
                   $post_date = $row['post_date'];
                   $post_image = $row['post_image'];
                   $post_content = $row['post_content'];

            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo imagePlaceholder($post_image); ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

                <!-- <div class="row">
                    <p class="pull-right"><a href="">Like</a></p>
                </div> -->
            
        <?php }
        
            
        
        ?>

        <!-- Blog Comments -->

            <?php
 
            if(isset($_POST['create_comment'])){

                if(isset($_SESSION['userRole'])){
                    $comment_author = mysqli_real_escape_string($connection, $_SESSION['username']);
                    $comment_email = mysqli_real_escape_string($connection, $_SESSION['email']);
                } else {
                    $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
                    $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
                }

                if(!empty($comment_author) && !empty($comment_email) && !empty($_POST['comment_content'])){
                    
                $that_post_id = $_GET['p_id'];

                
                
                
                $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);

                $query = "INSERT INTO comments (id_comment_post, comment_author, comment_email, comment_content, comment_status, comment_date)";
                $query .= "VALUES ($that_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                $create_comment_query = mysqli_query($connection, $query);

                confirmQuery($create_comment_query);
                //echo "<label id='testing' for=''>Your comment will be approved shortly!</label>";
                
                 

                // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                // $query .= "WHERE id_post = $that_post_id";
                // $update_comment_cnt = mysqli_query($connection, $query);

                } 
                else {
                    echo "<label id='testing' for=''>The fields can not be empty!</label>";
                }

                //redirect("/CMSProject_F099987/post.php?p_id=$that_post_id");
                
            }
            
            
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">

                    <?php
                    if(!isset($_SESSION['userRole'])){
                        echo '<div class="form-group">
                        <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>';

                        echo ' <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>';
                    }
                    ?>
                    

                       

                        <div class="form-group">
                            <label for="Comment">Your comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" id="commentButton" name="create_comment" class="btn btn-primary">Submit</button>
                        <?php if(isset($_POST['create_comment'])){
                            
                            if(isset($_SESSION['userRole'])){

                                if(!empty($_POST['comment_content'])){
                            echo "<label id='testing' for=''>Your comment will be approved shortly!</label>";
                                }
                            } else if(!empty($_POST['comment_author']) && !empty($_POST['comment_email']) && !empty($_POST['comment_content'])){
                                echo "<label id='testing' for=''>Your comment will be approved shortly!</label>";
                            }
                        } 
                         ?>
                        
                            <script>
                            function hideMessage() {
                                document.getElementById("testing").style.display = "none"
                            }
                            setTimeout(hideMessage, 5000);

                            </script>
                        
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                
                $query = "SELECT * FROM comments WHERE id_comment_post = {$that_post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY id_comment DESC ";

                $select_comment_query = mysqli_query($connection, $query);
                confirmQuery($select_comment_query);

                while($row = mysqli_fetch_array(($select_comment_query))){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    ?>


                        <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>

                        </div>
                    </div>

                    <?php
                        } }
                    } else {
                        header("Location: index.php");
                    }
                    ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div> <!-- closing div is in navigation php -->
        <!-- /.row -->

        <hr>

       <?php
       include "includes/footer.php";
       ?>