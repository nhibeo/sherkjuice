<?php
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "project");

    function db_connect(){
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        return $connection;
    }

    $db = db_connect();

    function db_disconnect(){
        if(isset($connection)){
            mysqli_close($connection);
        }
        return;
    }

    function confirm_query_result($result){
        global $db;
        if (!$result){
            echo mysqli_error($db);
            db_disconnect($db);
            exit; 
        } else {
            return $result;
        }
    }

    function insert_category($category){
        global $db;

        $sql = "INSERT INTO category ";
        $sql .= "(`name`, position, visible)";
        $sql .= "VALUES (";
        $sql .= "'" . $category['name'] . "', ";
        $sql .= "'" . $category['position'] . "', ";
        $sql .= "'" . $category['visible'] . "'";
        $sql .= ")";

        $result =  mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function find_all_category(){
        global $db;

        $sql = "SELECT * FROM `category` ";
        $sql .= "ORDER BY `name`";

        $result = mysqli_query($db, $sql);
        return $result;
    }

    function find_category_by_id($id) {
        global $db;
    
        $sql = "SELECT * FROM category ";
        $sql .= "WHERE categoryID='" . $id . "'";
        $result = mysqli_query($db, $sql);
        confirm_query_result($result);
        $category = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $category; 
    }

    function update_category($category) {
        global $db;
    
        $sql = "UPDATE category SET ";
        $sql .= "name='" . $category['name'] . "', ";
        $sql .= "position='" . $category['position'] . "', ";
        $sql .= "visible='" . $category['visible'] . "' ";
        $sql .= "WHERE categoryID='" . $category['categoryID'] . "' ";
        $sql .= "LIMIT 1";
    
        $result = mysqli_query($db, $sql);
        return confirm_query_result($result);
    }

    function delete_category($id) {
        global $db;
    
        $sql = "DELETE FROM category ";
        $sql .= "WHERE categoryID='" . $id . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
    
        return confirm_query_result($result);
    }
//========================================================
    function insert_product($product){
        global $db;

        $sql = "INSERT INTO product ";
        $sql .= "(categoryID, `name`, price, detail, picture) ";
        $sql .= "VALUES (";
        $sql .= "'" . $product['categoryID'] . "', ";
        $sql .= "'" . $product['name'] . "', ";
        $sql .= "'" . $product['price'] . "', ";
        $sql .= "'" . $product['detail'] . "', ";
        $sql .= "'" . $product['picture'] . "'";
        $sql .= ")";

        $result =  mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function find_all_product(){
        global $db;

        $sql = "SELECT * FROM `product` ";
        $sql .= "ORDER BY `name`";

        $result = mysqli_query($db, $sql);
        return $result;
    }

    function find_product_by_id($id) {
        global $db;
    
        $sql = "SELECT * FROM product ";
        $sql .= "WHERE productID='" . $id . "'";
        $result = mysqli_query($db, $sql);
        confirm_query_result($result);
        $product = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $product; 
    }

    function update_product($product) {
        global $db;
    
        $sql = "UPDATE product SET ";
        $sql .= "categoryID='" . $product['categoryID'] . "', ";
        $sql .= "name='" . $product['name'] . "', ";
        $sql .= "detail='" . $product['detail'] . "', ";
        $sql .= "price='" . $product['price'] . "', ";
        $sql .= "picture='" . $product['picture'] . "' ";
        $sql .= "WHERE productID='" . $product['productID'] . "' ";
        $sql .= "LIMIT 1";
    
        $result = mysqli_query($db, $sql);
        return confirm_query_result($result);
    }

    function delete_product($id) {
        global $db;
    
        $sql = "DELETE FROM product ";
        $sql .= "WHERE productID='" . $id . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
    
        return confirm_query_result($result);
    } 

     
?>
 