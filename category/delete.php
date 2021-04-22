<?php
require_once('database.php');
require_once('function.php');


if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    delete_category($_POST['categoryID']);
    redirect_to('index.php');
} else { // form loaded
    if(!isset($_GET['categoryID'])) {
        redirect_to('index.php');
    }
    $id = $_GET['categoryID'];
    $category = find_category_by_id($id);
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete category</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <p class="td">Delete category</p>
        <div class="con">
            <h2>Are you sure you want to delete this Category?</h2>
            <p class="del">Name: <?php echo $category['name']; ?></p>
        </div>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
            <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>" >   
            <div class="cc">
                <a href="index.php">Back to List</a> 
                <input type="submit" name="submit" value="Delete Category" class="aa">
            </div>
        </form>      
    </div>  
</body>
</html>

<?php
db_disconnect($db);
?>