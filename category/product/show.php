<?php
require_once('../database.php');
require_once('../function.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete category</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>
    <div class="container">
        <?php
                $id = $_GET['categoryID'];
                $category = find_category_by_id($id);
        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
            <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>" >   
        </form> 
        <a class="aa" href="../index.php">Back to List</a>
        <div class="sll">
            <p class="ss">Category: <?php echo $category['name']; ?></p>
            <div class="tt">
                <div class="con">
                    <div>MenuName: <?php echo $category['name']; ?></div>
                    <div>Position: <?php echo $category['position']; ?></div>
                    <div>Visible: <?php echo $category['visible']; ?></div>
                </div>
            </div>
        </div>
        <div class="tb">
            <p class="ss">Product</p>
            <a class="aa" href="<?php echo 'new.php?categoryID='. $id; ?>">Create New Product</a>
            <table class="list">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Detail</th>
                    <th>Picture</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                    $product_set = find_all_product();
                    $count = mysqli_num_rows($product_set);
                    for($i = 0; $i < $count; $i++):
                        $product = mysqli_fetch_assoc($product_set);
                ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['detail']; ?></td>
                    <td><?php echo $product['picture']; ?></td>
                    <td><a href="<?php echo 'product/show.php?productID='. $product['productID']; ?>">View</a></td>
                    <td><a href="<?php echo 'edit.php?productID='. $product['productID']; ?>">Edit</a></td>
                    <td><a href="<?php echo 'delete.php?productID='. $product['productID']; ?>">Delete</a></td>
                </tr>
                <?php
                    endfor;
                    mysqli_free_result($product_set);
                ?>
            </table>
        </div>
    </div>  
</body>
</html>

<?php
db_disconnect($db);
?>