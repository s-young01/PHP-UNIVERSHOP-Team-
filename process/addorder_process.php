<?php
    session_start();
    $json = json_decode(file_get_contents('php://input'));
    $productcode = $json -> productcode;
    $quantity = $json -> quantity;
    $address = $json -> address;
    $con=mysqli_connect("localhost","corona0113","kimdh991!","corona0113");
    $sql= "insert into userorder(o_productcode,o_id,o_addr,o_quantity)
    values({$productcode},
    '{$_SESSION['userid']}',
    '{$address}',
    {$quantity}
    )";
    $result = mysqli_query($con,$sql);
    if($result){
        echo "yes";
    }else{
        echo "실패{$sql}";
    }
?>