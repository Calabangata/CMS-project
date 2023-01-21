<table class = "table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>In response to</th>
                    <th>Date</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            
                <?php
                
                $query = "SELECT * FROM comments";
                $select_comments = mysqli_query($connection, $query);


                while($row = mysqli_fetch_assoc($select_comments)){
                    $comment_id = $row['id_comment'];
                    $id_comment_post = $row['id_comment_post'];
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_email = $row['comment_email'];
                    $comment_status = $row['comment_status']; 
                    $comment_date = $row['comment_date'];

                    echo "<tr>";
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";

                    // $query = "SELECT * FROM categories WHERE id_cat = $post_cat_id";
                    // $select_categories_id = mysqli_query($connection, $query);


                    // while($row = mysqli_fetch_assoc($select_categories_id)){
                    // $id_cat = $row['id_cat'];
                    // $cat_title = $row['cat_title'];

                    // echo "<td>{$cat_title}</td>";
                    // }



                    echo "<td>{$comment_email}</td>";
                
                    echo "<td>{$comment_status}</td>";

                        $query = "SELECT * FROM posts WHERE id_post = $id_comment_post";
                        $select_post_id_query = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_post_id_query)){
                            $post_id = $row['id_post'];
                            $post_title = $row['post_title'];
                        
                             echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                        }

                    echo "<td>{$comment_date}</td>";
                   

                    echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                    echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                    echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                    echo "</tr>";


                }
                
                
                ?>


        
            
        </tbody>
        </table>

        <?php 
        
        if(isset($_GET['delete'])){

            $the_comment_id = $_GET['delete'];
            $query = "DELETE FROM comments WHERE id_comment = $the_comment_id";
            $delete_query = mysqli_query($connection, $query);
            header("Location: comments.php");

        }

        if(isset($_GET['unapprove'])){

            $the_comment_id = $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE id_comment = $the_comment_id ";
            $unapprove_query = mysqli_query($connection, $query);
            header("Location: comments.php");

        }

        if(isset($_GET['approve'])){

            $the_comment_id = $_GET['approve'];
            $query = "UPDATE comments SET comment_status = 'approved' WHERE id_comment = $the_comment_id ";
            $approve_query = mysqli_query($connection, $query);
            header("Location: comments.php");

        }
        
        ?>