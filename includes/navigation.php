<?php
session_start();
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    
        <!-- <div class="container"> -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php
                
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_categories_query)){

                   $cat_title = $row['cat_title'];
                    $cat_id = $row['id_cat'];
                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                  // echo "<li><a href='#'>{$cat_title}</a></li>";

                }


                
                                // while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                                //     $cat_title = $row['cat_title'];
                                    
                                //     echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                //     }

                                
                
                
                ?>

                   

                    <?php
                    
                    if(isset($_SESSION['userRole'])){

                        if(isset($_GET['p_id'])){

                            $the_post_id = $_GET['p_id'];

                            echo "<li><a href ='admin/Posts.php?source=editPost&p_id={$the_post_id}'>Edit post</a></li>";
                        }
                    }
                    
                    ?>

                    
                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <?php
                    // if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == "Admin"){
                    //     echo "<li><a href='admin'>Admin</a></li>";
                    // } else {
                    //     echo "<li><a href='admin/subIndex.php'>Admin</a></li>";
                    // }

                     if(!isset($_SESSION['userRole'])){
                         echo "<li><a href='Login.php'>Log In</a></li>";

                         echo "<li><a class='marginRight10' href='registration.php'>Register now</a></li>";

                     } else if($_SESSION['userRole'] == "Admin"){
                        echo "<li><a href='admin'>Admin</a></li>";
                     } else {
                        echo "<li><a href='admin/subIndex.php'>Admin</a></li>";
                     }


                    

                    ?>


                    

                    <li class="dropdown">
                        <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-right: 10px;"><i class="fa fa-user"></i>  -->
                        <?php
                        if(isset($_SESSION['username'])){
                            echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' style='margin-right: 10px;'><i style='padding-right: 10px;' class='fa fa-user'></i>";
                            echo $_SESSION['username'];
                            echo "<b class='caret'></b></a>";
                        }
                        
                        ?>
                        
                        <ul class="dropdown-menu">
                            <li>
                                <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        <!-- </div> -->
        <!-- /.container -->
    </nav>