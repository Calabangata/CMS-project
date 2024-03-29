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
                            Admin Master
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>

                        <?php
                        
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else {
                            $source = "";
                        }

                        switch($source) {
                            
                            case 'addPost';
                            include "adminIncludes/addPost.php";
                            break;

                            case 'editPost';
                            include "adminIncludes/editPost.php";
                            break;

                            default:
                            include "adminIncludes/viewAllposts.php";
                            break;

                        }

                        ?>

                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->

    <?php include "adminIncludes/AdmFooter.php"; ?>
