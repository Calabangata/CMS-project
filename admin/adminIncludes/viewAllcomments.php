<?php

if(isset($_POST['checkBoxArray'])){


    foreach($_POST['checkBoxArray'] as $commentCheckId){
        $bulkOptions = $_POST['bulkOptions'];

        switch($bulkOptions){

            case 'approved':
                $query = "UPDATE comments SET comment_status = '{$bulkOptions}' WHERE id_comment = '{$commentCheckId}'";
                $sendQuery = mysqli_query($connection, $query);
                confirmQuery($sendQuery);
                break;

            case 'unapproved':
                $query = "UPDATE comments SET comment_status = '{$bulkOptions}' WHERE id_comment = '{$commentCheckId}'";
                $sendQuery = mysqli_query($connection, $query);
                confirmQuery($sendQuery);
                break;
                
            case 'delete':
                $query = "DELETE FROM comments WHERE id_comment = '{$commentCheckId}'";
                $sendQuery = mysqli_query($connection, $query);
                confirmQuery($sendQuery);
                break;

            default:
            break;
        }
    }

}

?>

<form action="" method="post">

<table class = "table table-bordered table-hover">

<div id="bulkOptionsContainer" class="col-xs-4" style="padding-left: 0px;">
            <select class="form-control" name="bulkOptions" id="bulk">
                <option value="">Select option</option>
                <option value="approved">Approve</option>
                <option value="unapproved">Unapprove</option>
                <option value="delete">Delete</option>
                <!-- <option value="clone">Clone</option> -->
                
            </select>
        </div>

        <div class="col-xs-4">

        <input type="submit" name="submit" value="Apply" class="btn btn-success" id="bulk">
        
        </div>

            <thead>
                <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
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
                
                if($_SESSION['userRole'] == "Admin"){

                $query = "SELECT * FROM comments ORDER BY id_comment DESC";
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
                    ?>

                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td>

                    <?php
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";
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

            } else {

                $userCheck = $_SESSION['username'];
                $query = "SELECT * FROM comments WHERE comment_author = '{$userCheck}'  ORDER BY id_comment DESC";
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
                    ?>

                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td>

                    <?php
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";
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

            }
                
                
                ?>


        
            
        </tbody>
        </table>

        </form>

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