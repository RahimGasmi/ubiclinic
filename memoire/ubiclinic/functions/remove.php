<?php 
require_once("../functions/config.php");
if($_GET['theme']=='patient'){


$id = $_GET['id'];
$sql = "DELETE FROM patient WHERE id = '$id'";
query($sql);
rederict('../edituser/');}
elseif($_GET['theme']=='app'){
$id = $_GET['id'];
$sql = "DELETE FROM appointments WHERE appid = '$id'";
query($sql);
rederict('../appointement/');}  
elseif($_GET['theme']=='medicine'){
    $id = $_GET['id'];
    $sql = "DELETE FROM medicine WHERE id = '$id'";
    query($sql);
    rederict('../medicine/');}  
    elseif($_GET['theme']=='examan'){
        $id = $_GET['id'];
        $sql = "DELETE FROM examan WHERE idexam = '$id'";
        query($sql);
        rederict('../medicine/');} 
?>