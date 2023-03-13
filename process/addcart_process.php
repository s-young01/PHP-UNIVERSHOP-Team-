<?php
    session_start();
    if(isset($_SESSION['userid'])){
    $conn = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");;
    $checksql = "select * from shoppingcart where c_productcode = {$_GET['productcode']}
    AND c_memberid = '{$_SESSION['userid']}'";
    $addsql = "";
    $checkrow= mysqli_fetch_array(mysqli_query($conn,$checksql));
    $total = $checkrow['c_quantity'] + $_GET['quantity'];
    $result;

    if($checkrow){
        // 값이있으면 원래있던 행의 갯수에서 이번에 추가하는 상품갯수추가
        $addsql = "update shoppingcart SET c_quantity = {$total}
        where c_productcode = {$_GET['productcode']}
        AND c_memberid = '{$_SESSION['userid']}'
        ";
        $result = mysqli_query($conn,$addsql);
        if($result){
            ?>
            <script>
                alert("상품이 추가되었습니다")
                history.back()
            </script>
            <?php
        }else{
            echo "실패";
            echo $addsql;
        }

    }else{
        $addsql = "insert into shoppingcart(c_memberid,c_productcode,c_quantity)
        values('{$_SESSION['userid']}',
        {$_GET['productcode']},
        {$_GET['quantity']}
        )";    
        $result = mysqli_query($conn,$addsql);
        if($result){
            ?>
            <script>
                alert("상품이 추가되었습니다")
                history.back()
            </script>
            <?php
        }else{
            echo "실패";
            echo $addsql;
        }
    }
}else{
?>
<script>
    location.replace( location.href="/teamplay/login.php");
</script> 
<?php
}
?>