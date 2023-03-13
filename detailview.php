<?php
 $temp="";
    if($_COOKIE['todayview']){
        $temp = explode(",",$_COOKIE['todayview']);
            if(!in_array($_GET['productcode'],$temp))
                {
                    setcookie('todayview',$_COOKIE['todayview'].','.$_GET['productcode'],time()+86400);
                }
    }else{ //쿠키가 없을경우
            setcookie('todayview',$_GET['productcode'],time()+86400);
    }
    include_once "./include/header.php"
?>

<?php

    $conn = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql = "select * from shopproduction where productcode = {$_GET['productcode']}";
    $result = mysqli_query($conn, $sql);
    $list = "";
    while($row=(mysqli_fetch_array($result))) {
        $price=number_format($row['price'],0,'.',',');
        $list = $list."
    <div id='productImg'>
        <img src='{$row['imageurl']}' alt=''>
    </div>
    <div id='buyInfo'>
        <div class='prodInfo'>
            <h3>{$row['name']}</h3>
            <nav>
                <p>
                    <span class='span1'>브랜드</span><span class='span2'>{$row['brand']}</span>
                </p>
                <p>
                    <span class='span1'>판매가</span><span class='span2'><strong>{$price}원</strong></span>
                </p>
                <p>
                    <span class='span1'>배송비</span><span class='span2'>2,500원</span>
                </p>
            </nav> 
        </div>
        <div id='buyPrice'>
            <span class='span1'>최소주문량 <strong>1</strong>개 이상 / 최대주문량 <strong>5</strong>개 이하</span>
            <table class='buyTable'>
                <tr>
                    <td>
                        <span class='span0'>상품명</span>
                    </td>
                    <td>
                        <span class='span0'>상품수</span>
                    </td>
                    <td>
                        <span class='span0'>가격</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class='span2'>{$row['name']}</span>
                    </td>
                    <td id='amountbox'>
                        <input type='text' name='amount' value='1' id='amount'>
                        <nav>
                            <button class='increbtn btn3'><i class='fa-solid fa-caret-up'></i></button>
                            <button class='decrebtn btn3'><i class='fa-solid fa-caret-down'></i></button>
                        </nav>
                    </td>
                    <td>
                        <span class='span2 price'>{$row['price']}</span> 
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan='3' class='total'>
                        TOTAL : <span class='priceInner'><strong>{$price}원</strong></span>
                    </td>
                </tr>
            </table>
        </div>
        ";
    }


    
?>
    <div id="detailPage">
        <?=$list?>
        <div id="buyBtn">
             <form action="/teamplay/orderform.php" method="get">
                <input type='hidden' name='productcode' value='<?=$_GET['productcode']?>'>
                <input type='hidden' name='quantity' value=1 id="orderamount" >
                <button type="submit" class="buybtn btn4">바로구매</button>
            </form>
            <form action="/teamplay/process/addcart_process.php" method="get">
                <input type='hidden' name='productcode' value='<?=$_GET['productcode']?>'>
                <input type='hidden' name='quantity' value=1 id="hiddenamount" >
                <button type="submit" class="cartbtn btn4">장바구니</button>
            </form>
            </div>
        </div>
    </div>
    <script src="/teamplay/javascript/detail_price.js"></script>
<?php
    include_once "./include/footer.php"
?>