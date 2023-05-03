<?php include "adminIncludes/AdmHeader.php"; ?>

<body>

    <div id="wrapper">


        <!-- Navigation -->
       <?php include "adminIncludes/AdmNavigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome to admin

                            

                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>

                       
                        
                    </div>
                </div>
                <!-- /.row -->


                       
                <!-- /.row -->
                
<div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                            <?php
                            // $query = "SELECT * FROM posts";
                            // $select_all_post = mysqli_query($connection, $query);
                            // $post_count = mysqli_num_rows($select_all_post);

                            $post_count = recordCount('posts');


                            echo "<div class='huge'>{$post_count}</div>";
                            ?>

                        
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="Posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                            <?php
                            
                            $comment_count = recordCount('comments');

                            echo "<div class='huge'>{$comment_count}</div>";
                            ?>

                     
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php
                            
                            $user_count = recordCount('users');
                            echo "<div class='huge'>{$user_count}</div>";
                            ?>

                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="Users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php
                            
                            $categories_count = recordCount('categories');
                            echo "<div class='huge'>{$categories_count}</div>";
                            ?>

                        
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="Categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>


                <!-- /.row -->

                <?php
                
                // $query = "SELECT * FROM posts WHERE post_status = 'published'";
                // $select_all_published_post = mysqli_query($connection, $query);
                // $post_published_count = mysqli_num_rows($select_all_published_post);
                $post_published_count = recordCountStatus('posts', 'post_status', 'published');
                
                $post_draft_count = recordCountStatus('posts', 'post_status', 'draft');                
                
                $unapproved_comments = recordCountStatus('comments', 'comment_status', 'unapproved');
              
                $subs_count = recordCountStatus('users', 'user_role', 'Subscriber');
                
                
                
                ?>


                <div class="row">


                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

            <?php
            
            $element_text = ['All posts', 'Active Posts', 'Draft posts', 'Comments', 'Pending comments', 'Total Users', 'Subscribers', 'Categories'];

            $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapproved_comments, $user_count, $subs_count, $categories_count];

            for($i = 0; $i <8; $i++) {
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }
            ?>

          //['Posts', 1000]
         
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->

    <?php include "adminIncludes/AdmFooter.php"; ?>
