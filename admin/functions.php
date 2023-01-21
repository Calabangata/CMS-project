<?php


function insertCategories(){

    global $connection;

    if(isset($_POST['submit'])){
                            
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title)";
            $query.= "VALUE('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query){

                die('QUERY FAILED' . mysqli_error($connection));
            }
        }

    }

}

function confirmQuery($check){

global $connection;

    if(!$check){
        die("Query failed" . mysqli_error($connection));
    }
    
}

function FindallCategories(){

global $connection;

$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);


while($row = mysqli_fetch_assoc($select_categories)){
    $id_cat = $row['id_cat'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
    echo "<td>{$id_cat}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href = 'Categories.php?delete={$id_cat}'>Delete</a></td>";
    echo "<td><a href = 'Categories.php?edit={$id_cat}'>Edit</a></td>";
    echo "</tr>";
}

}

function deleteCategory(){

    global $connection;
    if(isset($_GET['delete'])){


        $delete_category = $_GET['delete'];//{$delete_category}
        $query = "DELETE FROM categories WHERE id_cat = {$delete_category} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: Categories.php");
    }
    

}


?>