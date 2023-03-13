<?php
    $con = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    // 상품테이블에서 삭제할 상품코드를 참조하는 테이블이있는지 확인
    $sql = "delete from shopproduction where productcode = {$_POST['productcode']}";
    $result = mysqli_query($con,$sql);
    if($result){
        header("LOCATION:../productlist.php");
    }else{
        echo $sql;
    }
?>