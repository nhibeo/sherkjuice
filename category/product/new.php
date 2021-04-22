<?php 
    require_once('../database.php');
    require_once('../function.php');
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-size: 20px;
            color: #333;
        }
        body{
            justify-content: center;
            display: flex;
            height: 100vh;
            align-items: center;
            flex-wrap: wrap;
            background: #F5F5DC;
        }
        .container{
            max-width: 720px;
            width: 100%;
            background-color: #F5DEB3;
            padding: 30px 40px;
            border-radius: 10px;
            border:red 1px solid;
        }
        form{
            display: flex;
            justify-content: center;
        }
        .sll label{
            display: block;
            max-width: 300px;
            width: 100%;
        }
        .sll, .button{
            margin-top: 20px;
        }
        button{
            display: inline-flex;
        }
        input{
            border-radius:8px;
        }
        .button input{
            width: 40%;
            background-color: #E6E6FA;
            border-radius: 5px;
        }
        .button input:hover{
            background-color: #F0E68C;
        }
        li{
            position: relative;
            left: 30px;
        }
        .mb{
            border: double 1px red;
            padding:10px;

        }
        .mb li{
            color:#FF4500;
        }
        .td{
            position:relative;
            left: 200px;
            font-size: 40px;
            font-weight: bold;
        }
        a{
            border: solid 1px black;
            background: #fff;
            position:relative;
            top: 10px;
            border-radius: 5px;
            padding: 7px;
            text-decoration:none;
            color:#333;
            font-weight: bold;
        }
        a:hover{
            background: #ADD8E6;
            color:#191970;
            box-shadow: 5px 5px 10px #333;
        }
        .pro{
            border: solid 1px black;
            background: #fff;
            position:relative;
            top: 10px;
            border-radius: 5px;
            padding: 7px;
            left: 155px;
            text-decoration:none;
            color:#333;
            font-weight: bold;
        }
        #detail{
            max-width: 400px;
            min-width: 400px;
            width:100%;
            min-height:100px;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="td">ADD Product</div>
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
                <div class="sll">-------------------------------------------------------</div>
            </div>    
        </form>

        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isFormValidated()){
                $product = [];
                $product['categoryID'] = 2;
                $product['name'] = $_POST['name'];
                $product['price'] = $_POST['price'];
                $product['detail'] = $_POST['detail'];
                $product['picture'] = $_POST['picture'];
                $result = insert_product($product);
                redirect_to('product.php');
            }
        ?>     

        <a class="back" href="product.php">Back to Category</a>
    </div>
</body>
</html>

<?php 
    db_disconnect($db);
?>