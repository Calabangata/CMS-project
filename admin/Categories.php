<?php
 include "adminIncludes/AdmHeader.php";
 include "adminIncludes/modalDelete.php";    
?>


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

                        <div class="col-xs-6">

                        <?php
                        
                        insertCategories();

                        ?>

                        <form action="" method = "post">
                        <div class="form-group">
                        <label for="cat-title">Add Category</label>
                        <input type="text" class = "form-control" name="cat_title">
                        </div>

                        <div class="form-group">
                        <input class = "btn btn-primary" type="submit" name="submit" value = "Add Category">
                        </div>

                        </form>

                        <?php 
                        
                        if(isset($_GET['edit'])){

                            $id_cat = $_GET['edit'];
                            include "adminIncludes/updateCategories.php";
                        }
                        
                        ?>

                        </div>
                        <div class="col-xs-6">
                        <table class = "table table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thread>
                            <tbody>

                            <?php
                                FindallCategories();

                            ?>

                            <?php 
                            //delete query                          
                            deleteCategory();
                            ?>
                       
                            </tbody>
                        </table>

                        </div>
                        
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
