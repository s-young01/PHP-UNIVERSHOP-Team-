<?php
    $userid = $_GET['id'];
    $conn = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");;
    $sql = "select * from member where id = '{$userid}'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "yes";
    }else{
        echo "no";
    }
?>