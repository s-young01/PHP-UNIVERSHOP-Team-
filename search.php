<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php'
?>
<?php
    $condition="";
    $add = "?brand={$_GET['brand']}&searchselect={$_GET['searchselect']}&searchtext={$_GET['searchtext']}&price1={$_GET['price1']}&price2={$_GET['price2']}";
    if($_GET['condition']== 'name'){
        $condition = "order by name desc";
    }else if($_GET['condition']== 'pricerow'){
        $condition = "order by price asc";
    }else if($_GET['condition']== 'pricehigh'){
        $condition = "order by price desc";
    }else if($_GET['condition']== 'sales'){
        $condition = "order by sales desc";
    }
    $con = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql = "";
    $sqlcount = "";
    if($_GET['searchInput']){
        $add = "?searchInput={$_GET['searchInput']}";
        $sql = "select * from shopproduction where name like '%{$_GET['searchInput']}%' {$condition}";
        $sqlcount = "select count(*) from shopproduction where name like '%{$_GET['searchInput']}%'";
    }else if($_GET['brand'] && $_GET['searchselect'] && $_GET['searchtext'] && $_GET['price1'] && $_GET['price2']){
        $sql = "select * from shopproduction 
        where brand = '{$_GET['brand']}' 
        AND {$_GET['searchselect']} like '%{$_GET['searchtext']}%'
        AND price >= {$_GET['price1']} AND price <={$_GET['price2']} {$condition}";
        $sqlcount = "select count(*) from shopproduction 
        where brand = '{$_GET['brand']}' 
        AND {$_GET['searchselect']} like '%{$_GET['searchtext']}%'
        AND price >= {$_GET['price1']} AND price <={$_GET['price2']} ";
    }else if($_GET['brand'] && !$_GET['searchselect'] && !$_GET['searchtext'] && !$_GET['price1'] && !$_GET['price2']){
        // 브랜드만 입력되는경우
        $sql = "select * from shopproduction 
        where brand = '{$_GET['brand']}' {$condition}";
        $sqlcount = "select count(*) from shopproduction 
        where brand = '{$_GET['brand']}'";
    }else if(!$_GET['brand'] && $_GET['searchselect'] && $_GET['searchtext'] && !$_GET['price1'] && !$_GET['price2']){
        //상품명,상품코드
        $sql = "select * from shopproduction 
        where {$_GET['searchselect']} like '%{$_GET['searchtext']}%' {$condition}";
        $sqlcount = "select count(*) from shopproduction 
        where {$_GET['searchselect']} like '%{$_GET['searchtext']}%' ";
    }else if(!$_GET['brand'] && !$_GET['searchselect'] && !$_GET['searchtext'] && $_GET['price1'] && !$_GET['price2']){
        $sql = "select * from shopproduction
        where price >={$_GET['price1']} {$condition}";
        $sqlcount = "select count(*) from shopproduction
        where price >={$_GET['price1']}";
    }else if(!$_GET['brand'] && !$_GET['searchselect'] && !$_GET['searchtext'] && !$_GET['price1'] && $_GET['price2']){
        $sql = "select * from shopproduction
        where price <={$_GET['price2']} {$condition}";
        $sqlcount = "select count(*) from shopproduction
        where price <={$_GET['price2']}";
    }else if(!$_GET['brand'] && !$_GET['searchselect'] && !$_GET['searchtext'] && $_GET['price1'] && $_GET['price2']){
        $sql = "select * from shopproduction
        where price >={$_GET['price1']} AND
        price <={$_GET['price2']} {$condition}";
        $sqlcount = "select count(*) from shopproduction
        where price >={$_GET['price1']} AND
        price <={$_GET['price2']}";
    }
    if($sqlcount){
        $countresult = mysqli_query($con,$sqlcount);
            $countrow = mysqli_fetch_array($countresult);
    }
    $list = "";
    if($sql){
        $result = mysqli_query($con,$sql);
        while($row=(mysqli_fetch_array($result))){
            $list = $list."
            <tr>
                <td><img src='{$row['imageurl']}'></td>
                <td>{$row['productcode']}</td>
                <td><a href='detailview.php?productcode={$row['productcode']}'>{$row['name']}</a></td>
                <td>{$row['price']}</td>
                <td>{$row['brief']}</td>
            </tr>";
        }
    }
?>
    <div id="searchItems">
        <h2>상품검색</h2>
            <form action="">
            <table>
                <tr>
                    <th>
                        <span>상품분류</span>
                    </th>
                    <td>
                        <select name="brand" id="brand">
                            <option value="">상품분류 선택</option>
                            <option value="리그오브레전드">리그오브레전드</option>
                            <option value="블리자드">블리자드</option>
                            <option value="플레이스테이션">플레이스테이션</option>
                            <option value="닌텐도스위치">닌텐도스위치</option>
                            <option value="엑스박스">엑스박스</option>
                            <option value="배틀그라운드">배틀그라운드</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <span>검색조건</span>
                    </th>
                    <td>
                        <select name="searchselect">
                            <option value="">--</option>
                            <option value="name">상품명</option>
                            <option value="productcode">상품코드</option>
                        </select>
                        <input type="text" name="searchtext">
                    </td>
                </tr> 
                <tr>
                    <th>
                        <span>판매 가격대</span>
                    </th>
                    <td>
                        <input type="text" name="price1"> ~ <input type="text" name="price2">      
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="resultBtn">상품검색</button>
                    </td>
                </tr>
            </table>
            </form>           
    </div>
    <div id="resultItems">
        <div class="resultText">
            <span>Total <strong style="font-size: 24px;"><?=$countrow['count(*)']?></strong> Items</span>
            <ul>
               <li><a href="<?=$add?>&condition=name">상품명</a></li>
               <li><a href="<?=$add?>&condition=pricerow">낮은가격</a></li>
               <li><a href="<?=$add?>&condition=pricehigh">높은가격</a></li>
               <li><a href="<?=$add?>&condition=sales">판매량</a></li> 
            </ul>
        </div>
        <div class="resultData">
            <table class="resultTable">
                <tr>
                    <th>상품이미지</th>
                    <th style="width: 13%;">상품코드</th>
                    <th>이름</th>
                    <th style="width: 13%;">가격</th>
                    <th>설명</th>
                </tr>
                <?=$list?>
            </table>
        </div>
    </div>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php"
?>