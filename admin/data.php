<?php 
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "rcdatabase");
//da sua mot file nay  r nhe
function db_connect(){
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

$db = db_connect();

function db_disconnect($connection){
    if(isset($connection)){
        mysqli_close($connection);
    }
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


function find_usenmae($username) {
    global $db;
    $sql = "SELECT `PASSWORD` FROM admin ";
    $sql .= "WHERE USERNAME='" . $username . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $Login = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $Login; 
}
?>
