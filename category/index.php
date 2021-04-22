<?php
require_once('database.php');
require_once('function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a class="aa" href="new.php">Create New Category</a> <br> <br>
        <table class="list">
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Visible</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
                $category_set = find_all_category();
                $count = mysqli_num_rows($category_set);
                for($i = 0; $i < $count; $i++):
                    $category = mysqli_fetch_assoc($category_set);
            ?>
            <tr>
                
                <td><?php echo $category['name']; ?></td>
                <td><?php echo $category['position']; ?></td>
                <td><?php echo $category['visible']; ?></td>
                <td><a href="<?php echo 'product/show.php?categoryID='. $category['categoryID']; ?>">View</a></td>
                <td><a href="<?php echo 'edit.php?categoryID='. $category['categoryID']; ?>">Edit</a></td>
                <td><a href="<?php echo 'delete.php?categoryID='. $category['categoryID']; ?>">Delete</a></td>
            </tr>
            <?php
                endfor;
                mysqli_free_result($category_set);
            ?>
        </table>
    </div>

</body>
</html>

<?php
    db_disconnect($db);
?>