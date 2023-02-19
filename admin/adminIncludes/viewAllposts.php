        <form action="" method="post">

        <table class = "table table-bordered table-hover">


        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="" id="">
                <option value="">Select option</option>
                <option value="">Publish</option>
                <option value="">Draft</option>
                <option value="">Delete</option>
            </select>
        </div>

        <div class="col-xs-4">

        <input type="submit" name="submit" value="Apply" class="btn btn-success">
        <a href="addPost.php" class="btn btn-primary">Add new</a>
        </div>


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
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            
                <?php
                
                $query = "SELECT * FROM posts";
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

                    echo "<tr>";
                    ?>

                    <td><input class='CheckBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id;  ?>'> </td>;

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
                    echo "<td>{$post_comment_count}</td>";
                    echo "<td>{$post_date}</td>";
                    echo "<td><a href='Posts.php?source=editPost&p_id={$post_id}'>Edit</a></td>";
                    echo "<td><a href='Posts.php?delete={$post_id}'>Delete</a></td>";
                    echo "</tr>";


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