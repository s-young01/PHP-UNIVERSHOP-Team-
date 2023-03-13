<?php
        $con = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
        $sql = "update  shopproduction
        set name='{$_POST['name']}',
        price='{$_POST['price']}',
        brief='{$_POST['brief']}',
        brand='{$_POST['brand']}',
        imageurl='{$_POST['imageurl']}',
        recommend={$_POST['recommend']},
        type='{$_POST['type']}',
        sales={$_POST['sales']}
        where productcode = {$_POST['productcode']}
        ";
        $result = mysqli_query($con,$sql);
        if($result){
                header("Location:../productlist.php");
        }else{
                echo "끔찍하게 실패";
                echo $sql;
        }
    
?>