<?php
    session_start();
    $conn = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql = "delete from shoppingcart where c_memberid='{$_SESSION['userid']}'";
    $result = mysqli_query($conn, $sql);
    if($result){
    ?>
        <script>
            history.back();
        </script>
    <?php
        // header("LOCATION:../shop_cart.php");
    }else{
        echo "no";
    }
?>