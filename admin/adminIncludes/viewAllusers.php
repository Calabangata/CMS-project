<?php

if(isset($_POST['checkBoxArray'])){


    foreach($_POST['checkBoxArray'] as $userCheckId){
        $bulkOptions = $_POST['bulkOptions'];

        switch($bulkOptions){

            case 'Admin':
                $query = "UPDATE users SET user_role = '{$bulkOptions}' WHERE user_id = '{$userCheckId}'";
                $sendQuery = mysqli_query($connection, $query);
                confirmQuery($sendQuery);
                break;

            case 'Subscriber':
                $query = "UPDATE users SET user_role = '{$bulkOptions}' WHERE user_id = '{$userCheckId}'";
                $sendQuery = mysqli_query($connection, $query);
                confirmQuery($sendQuery);
                break;
                
            case 'delete':
                $query = "DELETE FROM users WHERE user_id = '{$userCheckId}'";
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
                <option value="Admin">Make admin</option>
                <option value="Subscriber">Make subscriber</option>
                <option value="delete">Delete</option>
                <!-- <option value="clone">Clone</option> -->
                
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" value="Apply" class="btn btn-success" id="bulk">
            <a href="Users.php?source=addUser" class="btn btn-primary" id="bulk">Add new user</a>
        </div>

            <thead>
                <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Username</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Change to Admin</th>
                    <th>Change to Subscriber</th>
                    <th>Update user</th>
                    <th>Delete User</th>
                    
                    
                </tr>
            </thead>
            <tbody>
            
                <?php
                
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $password = $row['user_password'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $email = $row['email'];
                    $user_image = $row['user_image'];
                    $role = $row['user_role']; 
                    //$randSalt = $row['randSalt'];

                    echo "<tr>";

                    ?>

                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $user_id; ?>'></td>

                    <?php

                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$firstname</td>";
                    echo "<td>$lastname</td>";

                    // $query = "SELECT * FROM categories WHERE id_cat = $post_cat_id";
                    // $select_categories_id = mysqli_query($connection, $query);


                    // while($row = mysqli_fetch_assoc($select_categories_id)){
                    // $id_cat = $row['id_cat'];
                    // $cat_title = $row['cat_title'];

                    // echo "<td>{$cat_title}</td>";
                    // }



                    echo "<td>$email</td>";
                    echo "<td>$role</td>";

                     echo "<td><a href='Users.php?changeAdmin={$user_id}'>Change to admin</a></td>";
                     echo "<td><a href='Users.php?changeSub={$user_id}'>Change to subscriber</a></td>";
                     echo "<td><a href='Users.php?source=editUser&update_user={$user_id}'>Update User</a></td>";
                    echo "<td><a href='Users.php?delete={$user_id}'>Delete</a></td>";
                    echo "</tr>";


                }
                
                
                ?>


        
            
        </tbody>
        </table>

        </form>

        <?php 
        
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin' && isset($_GET['delete'])){

            $user_id = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = $user_id";
            $delete_user_query = mysqli_query($connection, $query);
            header("Location: users.php");

        }

        if(isset($_GET['changeAdmin'])){

            $user_id = $_GET['changeAdmin'];
            $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $user_id ";
            $changeAdm_query = mysqli_query($connection, $query);
            header("Location: Users.php");

        }

        if(isset($_GET['changeSub'])){

            $user_id = $_GET['changeSub'];
            $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $user_id ";
            $changeSub_query = mysqli_query($connection, $query);
            header("Location: Users.php");

        }
        
        ?>