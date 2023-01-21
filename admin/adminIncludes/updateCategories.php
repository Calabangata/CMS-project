<form action="" method = "post">
            <div class="form-group">
            <label for="cat-title">Edit Category</label>

            <?php 

            if(isset($_GET['edit'])){

                $id_cat = $_GET['edit'];
            
            $query = "SELECT * FROM categories WHERE id_cat = $id_cat";
            $select_categories_id = mysqli_query($connection, $query);


                while($row = mysqli_fetch_assoc($select_categories_id)){
                $id_cat = $row['id_cat'];
                $cat_title = $row['cat_title'];

                //}
                ?>
            
            <input value = "<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class = "form-control" name="cat_title">
            
          <?php }
            }
          
                //opening and closing tags deleted
          
          //update query
          if(isset($_POST['update'])){


            $update_category = $_POST['cat_title'];//{$delete_category}
            $query = "UPDATE categories SET cat_title = '{$update_category}' WHERE id_cat = {$id_cat} ";
            $update_query = mysqli_query($connection, $query);

            if(!$update_query){
                die("query failed".mysqli_error($connection));
            }

          }
          
          ?>

            
            </div>

            <div class="form-group">
            <input class = "btn btn-primary" type="submit" name="update" value = "Update">
            </div>

        </form>