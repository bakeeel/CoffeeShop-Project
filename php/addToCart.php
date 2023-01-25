<?php

    include_once("DBConn.php");
    
    $id = $_POST['id'];

    $sql = "SELECT * FROM tbl_item WHERE ID = {$id}";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    echo $row['Sell_Price'];
?>