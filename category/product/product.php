<?php
require_once('../database.php');
require_once('../function.php');

$id = $_GET['categoryID'];
$category = find_category_by_id($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        *{
            color: #333;
        }
        body{
            justify-content: center;
            display: flex;
            height: 100vh;
            flex-wrap: wrap;
            background: #F5F5DC;
        }
        .container{
            max-width: 1000px;
            width: 100%;
            background-color: #F5DEB3;
            padding: 30px 40px;
            border-radius: 10px;
            border:red 1px solid;
        }
        .aa{
            max-width:100px;
            width: 100%;
            border: solid 1px black;
            background: #fff;
            position:relative;
            top: 10px;
            border-radius: 5px;
            padding: 7px;
            text-decoration:none;
            color:#333;
            font-weight: bold;
            text-decoration:none;
            text-align:center;
        }
        a{

            text-decoration:none;
        }
        .aa:hover{
            background: #ADD8E6;
            color:#191970;
            box-shadow: 5px 5px 10px #333;
        }
        table {
        border-collapse: collapse;
        vertical-align: top;
        }

        table.list {
        width: 100%;
        }

        table.list tr td {
        border: 1px solid #999999;
        }

        table.list tr th {
        border: 1px solid #0055DD;
        background: #CC6666;
        color: #333;
        text-align: left;
        }
        .sess{
            position:relative;
            left: 550px; 
        }
        .ttt{
            border-bottom: 1px solid black;
        }
        .ppp{
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="aa">
            <a href="../index.php">Back to List</a> 
        </div>
        
        <div class="ttt">
            <?php
                $category_set = find_all_category();
                $count = mysqli_num_rows($category_set);
                $category = mysqli_fetch_assoc($category_set);
                mysqli_free_result($category_set);
            ?>
            <h1><span>Category: </span><?php echo $category['name']; ?></h1>
            <h3><span>Menu Name: </span><?php echo $category['name']; ?></h3>
            <h3><span>Position: </span></h3>
            <h3><span>Visible: </span></h3>

            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>" >   
            </form>      
        </div>
        <div class="ppp">
            <a class="aa" href="new.php">Create New Category</a> <br> <br>
            <table class="list">
                <tr>
                    <th>Name</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <?php
                    $category_set = find_all_category();
                    $count = mysqli_num_rows($category_set);
                    for($i = 0; $i < $count; $i++):
                        $category = mysqli_fetch_assoc($category_set);
                ?>
                <tr>
                    
                    <td><?php echo $category['name']; ?></td>
                    <td><a href="<?php echo 'edit.php?categoryID='. $category['categoryID']; ?>">Edit</a></td>
                    <td><a href="<?php echo 'delete.php?categoryID='. $category['categoryID']; ?>">Delete</a></td>
                </tr>
                <?php
                    endfor;
                    mysqli_free_result($category_set);
                ?>
        </div>
    
    </div>

</body>
</html>

<?php
    db_disconnect($db);
?>