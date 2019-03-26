<?php
/**
 * Created by PhpStorm.
 * User: andy3
 * Date: 26/03/2019
 * Time: 15:37
 */
session_start();
session_destroy();
echo 'You have been logged out. <a href="index.php">Go back</a>';
header('location: index.php');
?>