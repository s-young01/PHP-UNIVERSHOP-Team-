<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php'
?>
<!-- header끝 -->
<?php
    $conn = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql = "select * from shopproduction where recommend = 1";
    $result = mysqli_query($conn, $sql);
    $list = "";
    while($row=(mysqli_fetch_array($result))) {
        $price=number_format($row['price'],0,'.',',');
        $list = $list."
        <li class='productList'>
            <div class='product'>
                <a href='detailview.php?productcode={$row['productcode']}'><img src={$row['imageurl']} alt=''>
                <span>{$row['name']}</span>
                </a>
            </div>
            <sp class='priceSpan'an>{$price}원</span>
            <div id='icon'>
                <a href='/teamplay/process/addcart_process.php?productcode={$row['productcode']}&quantity=1'><i class='fa-solid fa-cart-shopping' type ='submit'></i></a>
                <a href='/teamplay/orderform.php?productcode={$row['productcode']}&quantity=1'><i class='fa-solid fa-arrow-up-right-from-square'></i></a>
            </div>
        </li>
        ";
    }

    $sql2 = "select * from shopproduction where type='console' LIMIT 5";
    $result2 = mysqli_query($conn, $sql2);
    $list2 = "";
    while($row=(mysqli_fetch_array($result2))) {
        $price=number_format($row['price'],0,'.',',');
        $list2 = $list2."
        <li class='productlist2'>
            <div class='product2'>
                <a href='detailview.php?productcode={$row['productcode']}'><img src={$row['imageurl']} alt=''>
                <span>{$row['name']}</span>
                </a>
            </div>
            <span class='priceSpan'>{$price}원</span>
            <div id='icon'>
                <a href='/teamplay/process/addcart_process.php?productcode={$row['productcode']}&quantity=1'><i class='fa-solid fa-cart-shopping'></i></a>
                <a href='/teamplay/orderform.php?productcode={$row['productcode']}&quantity=1'><i class='fa-solid fa-arrow-up-right-from-square'></i></a>
            </div>
        </li>
        ";
    }

    $sql3 = "select * from shopproduction where type='goods' LIMIT 5";
    $result3 = mysqli_query($conn, $sql3);
    $list3 = "";
    while($row=(mysqli_fetch_array($result3))) {
        $price=number_format($row['price'],0,'.',',');
        $list3 = $list3."
        <li class='productlist2'>
            <div class='product2'>
                <a href='detailview.php?productcode={$row['productcode']}'><img src={$row['imageurl']} alt=''>
                <span>{$row['name']}</span>
                </a>
            </div>
            <span class='priceSpan'>{$price}원</span>
            <div id='icon'>
                <a href='/teamplay/process/addcart_process.php?productcode={$row['productcode']}&quantity=1'><i class='fa-solid fa-cart-shopping'></i></a>
                <a href='/teamplay/orderform.php?productcode={$row['productcode']}&quantity=1'><i class='fa-solid fa-arrow-up-right-from-square'></i></a>
            </div>
        </li>
        ";
    }
?>

        <main>
            <div id="banner">
                <ul id="imglists">
                    <li><img src="./image/banner1.jpg" alt=""></li>
                    <li><img src="./image/banner2.jpg" alt=""></li>
                    <li><img src="./image/banner3.jpg" alt=""></li>
                    <li><img src="./image/banner4.jpg" alt=""></li>
                </ul>
                <div id="prevbtn" class="btn"><span><</span></div>
                <div id="nextbtn" class="btn"><span>></span></div>
                <div id="indi"></div>
            </div>
            <div id="contents">
                <div id="recommend">
                    <div id="recommendprev" class="btn"><span><</span></div>
                    <div id="recommendnext" class="btn"><span>></span></div>
                    <h2>추천상품</h2>
                    <div id="recommendbox">
                        <ul class="recomProduct">
                        <?=$list?>
                        </ul>
                        <div id="recommendindi"></div>
                    </div>
                </div>
                <div id="best5">
                    <h2>베스트 TOP5</h2>
                    <div>
                        <ul class="best5Menu">
                            <li class="console menu">콘솔 게임</li>
                            <li class="goods menu">게임 굿즈</li>
                        </ul>
                        <div id="top5List">
                            <ul class="number">
                                <li>TOP 1</li>
                                <li>TOP 2</li>
                                <li>TOP 3</li>
                                <li>TOP 4</li>
                                <li>TOP 5</li>
                            </ul>
                        </div>
                        <div id="best5Product">
                            <ul class="best5List">
                                <?=$list2?>
                            </ul>
                            <!-- ul 하나 더 만들기 -->
                            <ul class="best5List2">
                                <?=$list3?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- footer시작 -->
        <script src="./javascript/best5.js"></script>
        <script src="./javascript/main.js"></script>      
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php"
?>
