<?php
    $json = json_decode(file_get_contents('php://input'));
    $c_no = $json -> c_no;
    $conn = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");;
    $sql = "delete from shoppingcart where c_no={$c_no}";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "yes";
    }else{
        echo "no";
    }
?>