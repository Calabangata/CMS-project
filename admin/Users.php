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
                            <small>Author</small>
                        </h1>

                        <?php
                        
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else {
                            $source = "";
                        }

                        switch($source) {
                            
                            case 'addUser';
                            include "adminIncludes/addUser.php";
                            break;

                            case 'editUser';
                            include "adminIncludes/editUser.php";
                            break;

                            default:
                            include "adminIncludes/viewAllusers.php";
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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>

