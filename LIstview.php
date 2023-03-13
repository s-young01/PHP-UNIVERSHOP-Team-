<?php
    include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php';
?>
<?php
    //정렬조건값
    // ***기획전 으로들어갈 변수값
    $title = "";
    $con = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql = "";
    $add = "";
    $sqlcount = "";
    $condition=""; //정렬조건문이 들어갈 변수
    // 조건을 받아서 추가
    if($_GET['condition']=='name'){
        $condition = "order by name desc";
    }else if($_GET['condition']=='pricerow'){
        $condition = "order by price asc";
    }else if($_GET['condition']=='pricehigh'){
        $condition = "order by price desc";
    }else if($_GET['condition']=='sales'){
        $condition = "order by sales desc";
    }
    
    if($_GET['type']){
        $add = "?type={$_GET['type']}";
        $sql = "select * from shopproduction where type = '{$_GET['type']}' {$condition}" ;
        $sqlcount = "select count(*) from shopproduction where type = '{$_GET['type']}'";
        $title = "굿즈";
    }else if($_GET['brand']){
        $add = "?brand={$_GET['brand']}";
        $sql = "select * from shopproduction where brand = '{$_GET['brand']}' {$condition}";
        $sqlcount = "select count(*) from shopproduction where brand = '{$_GET['brand']}' ";
        $title = $_GET['brand'];
    }else if($_GET['cate']){
        $add = "?cate={$_GET['cate']}";
        $title = $_GET['cate'];
        if($_GET['cate']=='오버워치' || $_GET['cate']=='월드오브워크래프트'){
            $sql="select * from shopproduction where name like '%{$_GET{'cate'}}%' {$condition}";
            $sqlcount="select count(*) from shopproduction where name like '%{$_GET{'cate'}}%'"; 
        }else if($_GET['cate']=='피규어' || $_GET['cate']=='케이스'){
            $sql="select * from shopproduction where name like '%{$_GET{'cate'}}%' AND brand='리그오브레전드' {$condition}";
            $sqlcount="select count(*) from shopproduction where name like '%{$_GET{'cate'}}%' AND brand='리그오브레전드'"; 
        }else if($_GET['cate']=='lifestyle'){
            $sql="select * from shopproduction where type ='{$_GET{'cate'}}' AND brand = '배틀그라운드' {$condition}";
            $sqlcount="select count(*) from shopproduction where type ='{$_GET{'cate'}}' AND brand = '배틀그라운드'";
        }
    }else{
        // 아무값도 받지못하는 경우
        $sql = "값이 없습니다";
    }

    $result = mysqli_query($con,$sql);
    $count = mysqli_query($con,$sqlcount);
    $countrow = mysqli_fetch_array($count);
    $list = "";
    while($row=mysqli_fetch_array($result)){
        $price=number_format($row['price'],0,'.',',');
        $list = $list."
        <li class='productlist2'>
        <div class='product2'>
            <a href='detailview.php?productcode={$row['productcode']}'><img src={$row['imageurl']} alt=''>
            <span>{$row['name']}</span>
            </a>
        </div>
        <span class='priceSpan'>{$price}원</span>
        <div id='icon'>
            <a href='/teamplay/process/addcart_process.php?productcode={$row['productcode']}&quantity=1'><i class='fa-solid fa-cart-shopping'></i></a>
            <a href='detailview.php?productcode={$row['productcode']}'><i class='fa-solid fa-arrow-up-right-from-square'></i></a>
        </div>
    </li>
    ";
}
    // 광고배너이미지위치 조건에따라변경
    $imgadd = "";
    if($_GET['brand']=='블리자드' || $_GET['cate']=='월드오브워크래프트' || $_GET['cate']=='오버워치'){
        $imgadd = "/teamplay/image/ad_blizzard.jpg";
    }else if($_GET['brand']=='리그오브레전드' || $_GET['cate']=='피규어' || $_GET['cate']=='케이스'){
        $imgadd = "/teamplay/image/ad_legueoflegends.jpg";
    }else if($_GET['brand']=='배틀그라운드' || $_GET['cate']=='lifestyle'){
        $imgadd = "/teamplay/image/ad_battlegrounds.jpg";
    }else{
        $imgadd = "/teamplay/image/ad_goods.jpg";
    }
?>
<div id="Listview">
    <div class="ad">
        <div class="route">
            <ol>
                <li><a href="/teamplay/index.php">홈</a></li>
                <li><?=$title?></li>
            </ol>
        </div>
        <p><img src=<?=$imgadd?> alt=""></p>
        <h2><?=$title?></h2>
    </div>
    <!-- 해당페이지에서 상세카테고리를 보여줌 -->
    <div class="submenu"></div>
    <div class="Listviewproduct">
        <div class="function">
            <p class="productcount">
                <strong><?=$countrow['count(*)']?></strong>
            </p>
            <ul>
               <li><a href="<?=$add?>&condition=name">상품명</a></li>
               <li><a href="<?=$add?>&condition=pricerow">낮은가격</a></li>
               <li><a href="<?=$add?>&condition=pricehigh">높은가격</a></li>
               <li><a href="<?=$add?>&condition=sales">판매량</a></li> 
            </ul>
        </div>
        <!-- 상품목록 -->
        <div class="listproduct">
            <ul class ="listviewLists">
                <?=$list?>
            </ul>
        </div>
        <ul class="pagemove">
            <li><a href=""><</a></li>
            <li><a href="">1</a></li>
            <li><a href="">></a></li>
        </ul>
    </div>
</div>
<?php
    include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php";
?>
