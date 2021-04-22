<?php 
    require_once('database.php');
    require_once('function.php');
    $errors = [];


    function isFormValidated(){
        global $errors;
        return count($errors) == 0;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_POST['name'])){
            $errors[] = '\'Name\' cannot be left blank ';
        }
        if(strlen($_POST['name']) > 50){
            $errors[] = '\'Name\' cannot exceed 50 characters ';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
    <p class="td">ADD CATEGORY</p>
    
        <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && !isFormValidated()): ?>
            <div class="mb">
                <span>Please FIX the following ERRORS !</span>
                <ul>
                    <?php 
                        foreach($errors as $key => $value){
                            if(!empty($value)){
                                echo '<li>', $value, '</li>';
                            }
                        }
                    ?> 
                </ul>
            </div>
         <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="box">
                <div class="sll">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo isFormValidated() ? '' : $_POST['name']; ?>">
                </div>
                <div class="sll">
                    <label for="position">Position</label>
                    <select name="position">
                        <option value="1" <?php if(!empty($_POST['position']) && $_POST['position'] == 1) echo 'selected'; ?>>1</option>
                        <option value="2" <?php if(!empty($_POST['position']) && $_POST['position'] == 2) echo 'selected'; ?>>2</option>
                        <option value="3" <?php if(!empty($_POST['position']) && $_POST['position'] == 3) echo 'selected'; ?>>3</option>
                        <option value="4" <?php if(!empty($_POST['position']) && $_POST['position'] == 4) echo 'selected'; ?>>4</option>
                        <option value="5" <?php if(!empty($_POST['position']) && $_POST['position'] == 5) echo 'selected'; ?>>5</option>
                    </select>
                </div>
                <div class="sll">
                    <label for="visible">Visible</label>
                    <input type="checkbox" value="FALSE" name="visible" id="visible" <?php if(!empty($_POST['visible'])) echo 'checked'; ?>>
                </div>

                <div class="button">
                    <input type="submit" value="Submit" name="submit">
                    <input type="reset" name="reset" value="Reset">
                </div>
                <div class="sll">-------------------------------------------------------</div>
            </div>    
        </form>
        
            <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isFormValidated()): ?>
                <?php 
                    $category = [];
                    $category['name'] = $_POST['name'];
                    $category['position'] = $_POST['position'];
                    if(!empty($_POST['visible'])){
                        $category['visible'] = 'true';
                    } else{
                        $category['visible'] = 'false';
                    }
                    $result = insert_category($category);
                    $newcategoryID = mysqli_insert_id($db);
                    redirect_to('product/show.php?categoryID=' . $newcategoryID);
                ?>           
            <?php endif; ?>
        <a class="back" href="index.php">Back to List</a>

    </div>
</body>
</html>

<?php 
    db_disconnect($db);
?>