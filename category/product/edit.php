<?php 
    require_once('../database.php');
    require_once('../function.php');

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
        if(empty($_POST['detail'])){
            $errors[] = '\'Detail\' cannot be left blank ';
        }
        if(empty($_POST['price'])){
            $errors[] = '\'Price\' cannot be left blank ';
        }
        if(empty($_POST['picture'])){
            $errors[] = '\'Picture\' cannot be left blank ';
        }
        if(is_numeric($_POST['price']) == false){
            $errors[] = '\'Price\' cannot be text ';
        }
        if($_POST['price'] < 0){
            $errors[] = '\'Price\' cannot be less than 0   ';
        }
    }



    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        checkForm();
        if (isFormValidated()){
            $product = [];
            $product['productID'] = $_POST['productID'];
            $product['name'] = $_POST['name'];
    
            update_product($product);
            redirect_to('show.php');
        }
    } else { 
        if(!isset($_GET['productID'])) {
            redirect_to('show.php');
        }
        $id = $_GET['productID'];
        $product = find_product_by_id($id);
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../style1.css">
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
                <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>" >  
                <div class="sll">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo isFormValidated() ? '' : $_POST['name']; ?>">
                </div>
                <div class="sll">
                    <label for="price">Price</label>
                    <input type="number" step ="any" name="price" value="<?php echo isFormValidated() ? '' : $_POST['price']; ?>">
                </div>
                <div class="sll">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" ><?php echo isFormValidated() ? '' : $_POST['detail']; ?></textarea>
                </div>
                <div class="sll">
                    <label for="picture">Picture</label>
                    <input type="file" name="picture">
                </div>

                <div class="button">
                    <input type="submit" value="Submit" name="submit">
                    <input type="reset" name="reset" value="Reset">
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php 
    db_disconnect($db);
?>