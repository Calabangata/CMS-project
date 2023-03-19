        <?php

        if(isset($_POST['checkBoxArray'])){

            foreach ($_POST['checkBoxArray'] as $postCheckId) {
                $bulkOptions = $_POST['bulkOptions'];

                switch ($bulkOptions) {
                    case 'published':
                        $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE id_post = '{$postCheckId}'";
                        $updateToPublish = mysqli_query($connection, $query);
                        confirmQuery($updateToPublish);
                        break;

                        case 'draft':
                            $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE id_post = '{$postCheckId}'";
                        $updateToDraft = mysqli_query($connection, $query);
                        confirmQuery($updateToDraft);
                        break;

                        case 'delete':
                            $query = "DELETE FROM posts WHERE id_post = {$postCheckId}";
                            $deleteQuery = mysqli_query($connection, $query);
                            confirmQuery($deleteQuery);
                        break;

                        case 'clone':

                            $query = "SELECT * FROM posts WHERE id_post = '{$postCheckId}'";
                            $select_post_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_array($select_post_query)){
                                $post_title = $row['post_title'];
                                $id_post_category = $row['id_post_category'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_tags = $row['post_tags'];
                                $post_content = $row['post_content'];
                                $post_image = $row['post_image'];
                                $post_status = $row['post_status'];
                            }

                            $query = "INSERT INTO  posts(id_post_category, post_title, post_author,
                            post_date, post_image, post_content, post_tags, post_status)";

                            $query .= "VALUES({$id_post_category},'{$post_title}','{$post_author}',now(),
                            '{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

                            $send_post_query = mysqli_query($connection, $query);

                            confirmQuery($send_post_query);
                            break;

                            case 'resetViews':
                                $query = "UPDATE posts SET post_views = 0 WHERE id_post = '{$postCheckId}'";
                                $updateQuery = mysqli_query($connection, $query);
                                confirmQuery($updateQuery);
                                break;

                     
                    default:
                        # code...
                        break;
                }
        
            }

        }

        ?>
        
        <form action="" method="post">

        <table class = "table table-bordered table-hover">

        <?php
        
        if($_SESSION['userRole'] == "Admin"){
            echo '<div id="bulkOptionsContainer" class="col-xs-4" style="padding-left: 0px;">
            <select class="form-control" name="bulkOptions" id="bulk">
                <option value="">Select option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                <option value="resetViews">Reset views</option>
            </select>
        </div>

        <div class="col-xs-4">
        <input type="submit" name="submit" value="Apply" class="btn btn-success" id="bulk">
        <a href="Posts.php?source=addPost" class="btn btn-primary" id="bulk">Add new post</a>
        </div>';

        } else {
            //bulk options for subscriber
            echo '<div id="bulkOptionsContainer" class="col-xs-4" style="padding-left: 0px;">
            <select class="form-control" name="bulkOptions" id="bulk">
                <option value="">Select option</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                <option value="resetViews">Reset views</option>
            </select>
        </div>

        <div class="col-xs-4">
        <input type="submit" name="submit" value="Apply" class="btn btn-success" id="bulk">
        <a href="Posts.php?source=addPost" class="btn btn-primary" id="bulk">Add new post</a>
        </div>';
        }
        
        ?>

        


            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>View post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            
                <?php

                if($_SESSION['userRole'] == "Admin"){

                    $query = "SELECT * FROM posts ORDER BY id_post DESC";
                    $select_posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_posts)){
                        $post_id = $row['id_post'];
                        $post_author = $row['post_author'];
                        $post_title = $row['post_title'];
                        $post_cat_id = $row['id_post_category'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_views = $row['post_views'];

                        echo "<tr>";
                        ?>

                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

                        <?php
                        
                        echo "<td>{$post_id}</td>";
                        echo "<td>{$post_author}</td>";
                        echo "<td>{$post_title}</td>";

                        $query = "SELECT * FROM categories WHERE id_cat = $post_cat_id";
                        $select_categories_id = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_categories_id)){
                        $id_cat = $row['id_cat'];
                        $cat_title = $row['cat_title'];

                        echo "<td>{$cat_title}</td>";
                        }

                        echo "<td>{$post_status}</td>";
                        echo "<td><img width='100' src = '../images/{$post_image}' alt = 'image'></td>";
                        echo "<td>{$post_tags}</td>";

                        $query = "SELECT * FROM comments WHERE id_comment_post = $post_id";
                        $sendCommentcountQuery = mysqli_query($connection, $query);
                        confirmQuery($sendCommentcountQuery);

                        while($row = mysqli_fetch_array($sendCommentcountQuery)){
                            $comment_id = $row['id_comment'];
                        }
                        
                        $commentCount = mysqli_num_rows($sendCommentcountQuery);

                        echo "<td><a href='postComments.php?id=$post_id'>{$commentCount}</a></td>";
                        echo "<td>{$post_date}</td>";
                        echo "<td>{$post_views}</td>";
                        echo "<td><a href='../post.php?p_id=$post_id'>View post</a></td>";
                        echo "<td><a href='Posts.php?source=editPost&p_id={$post_id}'>Edit</a></td>";
                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?'); \" href='Posts.php?delete={$post_id}'>Delete</a></td>";
                        echo "</tr>";

                    }

                } else {

                    $userCheck = $_SESSION['username'];

                    $query = "SELECT * FROM posts WHERE post_author = '{$userCheck}' ORDER BY id_post DESC";
                    $select_posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_posts)){
                        $post_id = $row['id_post'];
                        $post_author = $row['post_author'];
                        $post_title = $row['post_title'];
                        $post_cat_id = $row['id_post_category'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_views = $row['post_views'];

                        echo "<tr>";
                        ?>

                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

                        <?php
                        
                        echo "<td>{$post_id}</td>";
                        echo "<td>{$post_author}</td>";
                        echo "<td>{$post_title}</td>";

                        $query = "SELECT * FROM categories WHERE id_cat = $post_cat_id";
                        $select_categories_id = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_categories_id)){
                        $id_cat = $row['id_cat'];
                        $cat_title = $row['cat_title'];

                        echo "<td>{$cat_title}</td>";
                        }

                        echo "<td>{$post_status}</td>";
                        echo "<td><img width='100' src = '../images/{$post_image}' alt = 'image'></td>";
                        echo "<td>{$post_tags}</td>";

                        $query = "SELECT * FROM comments WHERE id_comment_post = $post_id";
                        $sendCommentcountQuery = mysqli_query($connection, $query);
                        confirmQuery($sendCommentcountQuery);

                        while($row = mysqli_fetch_array($sendCommentcountQuery)){
                            $comment_id = $row['id_comment'];
                        }
                        
                        $commentCount = mysqli_num_rows($sendCommentcountQuery);

                        echo "<td><a href='postComments.php?id=$post_id'>{$commentCount}</a></td>";
                        echo "<td>{$post_date}</td>";
                        echo "<td>{$post_views}</td>";
                        echo "<td><a href='../post.php?p_id=$post_id'>View post</a></td>";
                        echo "<td><a href='Posts.php?source=editPost&p_id={$post_id}'>Edit</a></td>";
                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?'); \" href='Posts.php?delete={$post_id}'>Delete</a></td>";
                        echo "</tr>";

                    }

                }
                
                
                ?>


        
            
        </tbody>
        </table>

        </form>

        <?php 
        
        if(isset($_GET['delete'])){

            $the_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE id_post = {$the_post_id}";
            $delete_query = mysqli_query($connection, $query);
            header("Location: Posts.php");
        }
        
        ?>