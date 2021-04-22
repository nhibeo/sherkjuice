<?php 
    require_once('database.php');
    require_once('function.php');

    $errors = [];

    function isFormValidated(){
        global $errors;
        return count($errors) == 0;
    }

    function checkForm(){
        global $errors;     
        if(empty($_POST['name'])){
            $errors[] = '\'Name\' cannot be left blank ';
        }
        if(strlen($_POST['name']) > 50){
            $errors[] = '\'Name\' cannot exceed 50 characters ';
        }
    }



    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        checkForm();
        if (isFormValidated()){
            $category = [];
            $category['categoryID'] = $_POST['categoryID'];
            $category['name'] = $_POST['name'];
    
            update_category($category);
            redirect_to('index.php');
        }
    } else { 
        if(!isset($_GET['categoryID'])) {
            redirect_to('index.php');
        }
        $id = $_GET['categoryID'];
        $category = find_category_by_id($id);
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
    <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && !isFormValidated()):?>
        <div class="output">
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
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="box">
                <div class="sll">
                    <p class="td">Edit Category</p>
                </div>
                
                <input type="hidden" name="categoryID" value="<?php echo isFormValidated()? $category['categoryID']: $_POST['categoryID'] ?>" >
                <div class="sll" style="margin-left:100px;">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo isFormValidated() ? $category['name'] : $_POST['name']?>">
                </div>
                <div class="sll">
                    <a  href="index.php">Back To List</a>
                    <a  href="<?php echo 'product/show.php?categoryID='. $category['categoryID']; ?>">Edit Product</a>
                    <input  type="submit" name="submit" value="Submit" class="aa">
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php 
    db_disconnect($db);
?>