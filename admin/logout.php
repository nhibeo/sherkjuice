<?php
require_once('initialize.php');

unset($_SESSION['name']);
// $_SESSION['name'] = NULL;

redirect_to('login.php');
exit;
?>