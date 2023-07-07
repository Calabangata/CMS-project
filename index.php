<?php
ob_start();
 include "includes/db.php";
 include "includes/header.php";
  ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <h1 class="page-header">
                    CMS Project
                    <small>Made by Kristiyan Rulev</small>
                    <hr class="">
                </h1>


            <?php

            $postsPerpage = 5;

            if(isset($_GET['page'])){

                $page = $_GET['page'];
                
            } else {
                $page = "";
            }

            if($page == "" || $page == 1){
                $page_1 = 0;
            } else {
                $page_1 = ($page * $postsPerpage) - $postsPerpage;
            }

            $postCountQuery = "SELECT * FROM posts WHERE post_status = 'published'";
            $findCount = mysqli_query($connection, $postCountQuery);
            $count = mysqli_num_rows($findCount);          
            $count = ceil($count / $postsPerpage); // counting how many pages I get
            
            $query = "SELECT * FROM posts LIMIT $page_1, $postsPerpage";
            $select_all_posts_query = mysqli_query($connection, $query);
            $simplecnt = 0;

                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['id_post'];
                   $post_title = $row['post_title'];
                   $post_author = $row['post_author'];
                   $post_date = $row['post_date'];
                   $post_image = $row['post_image'];
                   $post_content = substr($row['post_content'], 0, 100);
                   $post_status = $row['post_status'];

                   if($post_status == 'published'){
                    

            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="authorPosts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <!-- <hr> -->
            
            <?php
                $simplecnt = 1;
            }
        
        } 

        if($simplecnt == 0){
            echo "<img class='img-responsive margins' src='images/NoResultsFound.png'>";
            echo "<a class='btn btn-primary' href='addPostfromCategory.php'>Add a post</a>";
        }
        
        ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div> <!-- closing div is in navigation php -->
        <!-- /.row -->

        <hr class="line-for-index">

        <ul class="pager">
        <?php
        for($i = 1; $i <= $count; $i++){

            if($i == $page){
                echo "<li><a class='activeLink' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }

        ?>
        </ul>

       <?php
       include "includes/footer.php";
       ?>