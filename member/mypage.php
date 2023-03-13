<?php
    session_start();
    if(isset($_SESSION['userid'])){
    include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php';

// 상품주문정보 mysql에서 받아오기
$con = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
//로그인중인 세션아이디 값을 받아와 order테이블에 해당 유저의 주문정보를 받아오는 ordersql
$ordersql="select userorder.o_no , shopproduction.imageurl ,shopproduction.name ,
userorder.o_quantity,shopproduction.price from 
shopproduction inner join userorder
on shopproduction.productcode = userorder.o_productcode 
where userorder.o_id='{$_SESSION['userid']}'";
$resultorder =mysqli_query($con,$ordersql);
//countrow는 ordersql(주문 상품정보 리스트의 갯수를 확인하는 변수)
$countrow = mysqli_num_rows($resultorder);

//orderrow 는 resultorder를 배열로 펼친 변수이다.
// $orderrow = mysqli_fetch_array($resultorder);
// var_dump($orderrow);
$list2 = "";
//세션아이디로 접속한 사람이 주문한 상품리스의 제품코드와 같은 제품 정보를 가져오는변수 
$productinfosql = "select * from shopproduction where productcode = '{$orderrow['o_productcode']}'"; 
$productinforesult = mysqli_query($con,$productinfosql);
$productinforow = mysqli_fetch_array($productinforesult);
// var_dump($productinforow);
while($orderrow = (mysqli_fetch_array($resultorder))) {
    $list2 = $list2."
        <tr>
            <td>{$orderrow['o_no']}</td>
            <td><img src={$orderrow['imageurl']}></td>
            <td><span class='span2'></span>{$orderrow['name']}</td>
            <td><span class='countSpan'>{$orderrow['o_qauntity']}</span> 개</td>
            <td><strong>{$orderrow['price']}</strong></td>
            <td>배송준비중</td>
        </tr>
     ";
}

// 주문 상품이 없을 때 화면
if($countrow == 0) {
    $list2 = $list2."
        <tr id='noneorder'>
            <td colspan='6'>
                <p>주문한 상품이 없습니다.</p>
            </td>
        </tr>
    ";
}
 
$sql = "select * from member where id = '{$_SESSION['userid']}'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$sql2 = "select count(*) from shoppingcart where c_memberid = '{$_SESSION['userid']}'";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($result2);
$list = "";
// 최근본상품부분
$temp = explode(",",$_COOKIE['todayview']);
if(explode(",",$_COOKIE['todayview'])[0] == 0){
    $temp = 0;
}
$count = 0;

if($temp){
    for($i=0;$i<=sizeof($temp)-1;$i++){
        $count++;
        $sql3 = "select * from shopproduction where productcode = {$temp[$i]}"; 
        $result3 = mysqli_query($con,$sql3);
        if($result3){
            $row3 = mysqli_fetch_array($result3);
        }
        $price=number_format($row3['price'],0,'.',',');
        $list = $list."
            <tr>
                <td>
                    <img src='{$row3['imageurl']}' alt=''>
                </td>
                <td><span class='span2'><a href='/teamplay/detailview.php?productcode={$row3['productcode']}'>{$row3['name']}</a></span></td>
                <td><strong>{$price}원</strong></td>
                <td>
                    <nav id='selecbtn'>
                        <button class='orderbtn btn5'>주문하기</button>
                        <button data-productcode='{$row3['productcode']}' class='deletebtn btn5'>X 삭제</button>
                    </nav> 
                </td>
            </tr>
        ";
    };
}

// 최근 본 상품이 없을 때 화면
    if($count==0 && $temp==""){
        $list="
        <tr id='nonerecently'>
            <td colspan='5'>
                <p>최근 본 상품이 없습니다.</p>
            </td>
        </tr>
        ";
    }
?>

<div id="mypage">
    <div class="path">
        <ul>
            <li><a href="/teamplay/index.php">홈</a></li>
            <li>> 장바구니</li>
        </ul>
    </div>
    <h2>마이페이지</h2>
    <div id="userzone">
        <div id="userleft">
            <nav class="userimg">
                <img src="../image/mypage_img.png" alt="">
            </nav>
            <span><strong><?=$row['name']?></strong></span>
            <span class="span0"><strong>WELCOME</strong></span>
        </div>
        <div id="userright">
            <p>환영합니다.<span class="span1"><strong><?=$row['name']?></strong></span>님!</p>
            <ul class="userlist">
                <li><a href="#">주문정보</a></li>
                <li><a href="/teamplay/shop_cart.php">장바구니</a>(<span><?=$row2['count(*)']?></span>)</li>
                <li><a href="#">최근 본 상품</a>(<span><?=$count?></span>)</li>
            </ul>
        </div>
    </div>
    <div id="orderInfo">
        <p><strong><i class="fa-regular fa-folder-closed"></i>주문 상품 정보</strong></p>
        <table id="orderInfoTable">
            <thead>
                <tr>
                    <th width='5%'>번호</th>
                    <th width='15%'>이미지</th>
                    <th width='40%'>상품정보</th>
                    <th width='10%'>수량</th>
                    <th width='15%'>상품구매금액</th>
                    <th width='15%'>주문처리상태</th>
                </tr>
            </thead>
            <tbody>
                <?=$list2?>
            </tbody>
        </table>
    </div>
    <div id="recently">
        <p><strong><i class="fa-regular fa-clock"></i>최근 본 상품</strong></p>
        <table id="recentlyTable">
            <thead>
                <tr>
                    <th width='15%'>이미지</th>
                    <th width='40%'>상품명</th>
                    <th width='20%'>판매가</th>
                    <th width='25%'>선택</th>
                </tr>
            </thead>
            <tbody>
                <?=$list?>
            </tbody>
        </table>
    </div>
</div>
<script>
const delbtns=document.querySelectorAll('.deletebtn');
delbtns.forEach(btn=>{
    btn.addEventListener('click',function(e){
        let delnum = e.target.dataset.productcode;
        let delarr = getCookie('todayview');
            let newarr = delarr.filter(function(data){
                return data !== delnum
            })
            console.log(delarr)
            console.log(newarr)
            console.log(newarr.join('%2C'))
            deleteCookie('todayview')
            setCookie('todayview',newarr,86400)
            window.location.reload() 
        
    })
})
function getCookie(name) {
      let value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
      return value? value[2].split('%2C') : null;
};
function setCookie(key, value, expiredays) {
    let todayDate = new Date();
    todayDate.setDate(todayDate.getDate() + expiredays);
    document.cookie = key + "=" + escape(value) + "; path=/teamplay; expires=" + todayDate.toGMTString() + ";"
}
function deleteCookie(name) {
	document.cookie = name + '=; expires=Thu, 01 Jan 1999 00:00:10 GMT;';
}


</script>

<?php
    include_once "../include/footer.php"
?>
<?php
}else{
?>
<script>
    location.replace( location.href="/teamplay/login.php");
</script>
<?php    
}
?>