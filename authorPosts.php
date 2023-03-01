<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<link href="css/style.css" rel="stylesheet">
    
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                                Page Heading
                                <small>Secondary Text</small>
                            </h1>

            <?php

            if(isset($_GET['author'])){
                //$that_post_id = $_GET['p_id'];
                $that_post_author = $_GET['author'];
            }
            
            $query = "SELECT * FROM posts WHERE post_author = '{$that_post_author}' ";
            $select_all_posts_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)){

                    $that_post_id = $row['id_post'];
                   $post_title = $row['post_title'];
                   $post_author = $row['post_author'];
                   $post_date = $row['post_date'];
                   $post_image = $row['post_image'];
                   $post_content = $row['post_content'];

            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $that_post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

          
            
            <?php } ?>

        <!-- Blog Comments -->
                <!-- php code for post form comment -->
            <?php
 
            // if(isset($_POST['create_comment'])){

            //     $that_post_id = $_GET['p_id'];
            //     $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
            //     $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
            //     $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);

            //     if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

            //     $query = "INSERT INTO comments (id_comment_post, comment_author, comment_email, comment_content, comment_status, comment_date)";
            //     $query .= "VALUES ($that_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

            //     $create_comment_query = mysqli_query($connection, $query);

            //     confirmQuery($create_comment_query);

            //     $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
            //     $query .= "WHERE id_post = $that_post_id";
            //     $update_comment_cnt = mysqli_query($connection, $query);

            //     } else {
            //         echo "<script>alert('Fields can not be empty!');</script>";
            //     }

                
            // }
                ?>

                <!-- Comments Form -->
                

                <!-- Posted Comments -->
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div> <!-- closing div is in navigation php -->
        <!-- /.row -->

        <hr>

       <?php
       include "includes/footer.php";
       ?>