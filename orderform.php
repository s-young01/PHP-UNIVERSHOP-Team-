<?php
    session_start();
    if(isset($_SESSION['userid'])){
    include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php';
    $conn = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql = "select * from shopproduction where productcode = {$_GET['productcode']}";
    if($_GET['cartorder']) {
        $sql = "select shopproduction.imageurl , shopproduction.name, 
        shopproduction.price , shoppingcart.c_quantity, shoppingcart.c_no,
        shoppingcart.c_memberid, shopproduction.productcode
        from
        shopproduction inner join shoppingcart
        on shopproduction.productcode = shoppingcart.c_productcode
        where shoppingcart.c_memberid = '{$_SESSION['userid']}'
        ";
    }

    $sqlcount = "select count(*) from shopproduction where productcode = {$_GET['productcode']}";
    $sql2 = "select * from member where id='{$_SESSION['userid']}'";

    $resultcount = mysqli_query($conn,$sqlcount);
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn,$sql2);
    if($_GET['productcod']){
        $rowcount = mysqli_fetch_array($resultcount);
    }
    $row2 = mysqli_fetch_array($result2);
    $resultrows = mysqli_num_rows($result);

    $list="";
    
    if($resultrows == 1){
        $row=mysqli_fetch_array($result);
        $totalProduct = number_format($row['price']*$_GET['quantity'],0,'.',',');
        $totaldelProduct = number_format($totaldelProduct+2500,0,'.',',');
        $deleprice = number_format(2500,0,'.',',');
        $price = number_format($row['price'],0,'.',',');
        $list = "
        <tr class='row'>
            <td>
                <input type='hidden' value={$row['productcode']} class='productcode'>
                <label class='container'>
                    <input type='checkbox' checked='checked' class='cartcheck' name='product'
                    data-price={$row['price']}
                    data-del=2500
                    data-quan={$_GET['quantity']}
                    >
                    <span class='checkmark'></span>
                </label>
            </td>
            <td>
                <img src={$row['imageurl']} alt=''>
            </td>
            <td><span class='span0'><a href='/teamplay/detailview.php?productcode={$row['productcode']}'>{$row['name']}</a></span></td>
            <td><strong class='price'>{$row['price']}</strong></td>
            <td>
                <span class='quantity'>{$_GET['quantity']}</span>
            </td>
            <td>
                <span>기본배송</span>
            </td>
            <td>
                <span><strong>{$totalProduct}</strong></span> 
            </td>
        </tr>
        ";
        }else if($resultrows > 1){
            while($row = (mysqli_fetch_array($result))){
                $totalProduct = number_format($row['price']*$row['c_quantity'],0,'.',',');
                $totaldelProduct = number_format($totaldelProduct+2500,0,'.',',');
                $deleprice = number_format(2500,0,'.',',');
                $price = number_format($row['price'],0,'.',',');
                $list=$list."
                <tr class='row'>
                <td>
                    <input type='hidden' value={$row['productcode']} class='productcode'>
                    <label class='container'>
                        <input type='checkbox' checked='checked' class='cartcheck' name='product'
                        data-price={$row['price']}
                        data-del=2500
                        data-quan={$_GET['quantity']}
                        >
                        <span class='checkmark'></span>
                    </label>
                </td>
                <td>
                    <img src={$row['imageurl']} alt=''>
                </td>
                <td><span class='span0'><a href='/teamplay/detailview.php?productcode={$row['productcode']}'>{$row['name']}</a></span></td>
                <td><strong class='price'>{$row['price']}</strong></td>
                <td>
                    <span class='quantity'>{$row['c_quantity']}</span>
                </td>
                <td>
                    <span>기본배송</span>
                </td>
                <td>
                    <span><strong>{$totalProduct}</strong></span> 
                </td>
            </tr>";
            }
        }else{
        $list = "
            <tr id='noneorder'>
                <td></td>
                <td></td>
                <td colspan='4'>
                    <p>주문할 상품이 담겨있지 않습니다.</p>
                </td>
            </tr>
        ";
    }
?>
<div id="oderpage">
    <div class="path">
        <ul>
            <li>
                <a href="/teamplay/index.php">홈</a>
            </li>
            <li>
                ><span> 주문서 작성</span>
            </li>
        </ul>
    </div>
    <div id="orderform">
        <h2>주문서 작성</h2>
        <ul id="prodcamount">
            <li>주문상품(<?=$resultrows?>)</li>
        </ul>
        <table id="orderTable">
            <thead>
                <tr>
                    <th width='5%'>
                        <label class="container">
                            <input type="checkbox" onclick="allselect(this)">
                            <span class="checkmark"></span>
                        </label>
                    </th>
                    <th width='10%'>이미지</th>
                    <th width='35%'>상품정보</th>
                    <th width='15%'>판매가</th>
                    <th width='5%'>수량</th>
                    <th width='15%'>배송구분</th>
                    <th width='15%'>합계</th>
                </tr>
            </thead>
            <tbody>
                <?=$list?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='7'>
                        <div class="totalorder">
                            <span>상품구매금액</span><strong id="productprice"><?=$_GET['quantity']*$row['price']?>원</strong>
                            <span> + 배송비 </span><span id="delprice">2,500</span>
                            <span>= 합계 : </span><strong id="totalprice"><?=$_GET['quantity']*$row['price']+"2500"?>원</strong>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <ul id="alldelete1">
            <li>
                <span>전체상품을</span>
                <form action="/teamplay/process/cartdelall_process.php">
                    <button class="alldeletebtn btn6">X 삭제하기</button>
                </form>
            </li>
            <li>
                <button  class="prevpage">이전페이지 ></button>
            </li>
        </ul>   
    </div>
    <div id="delInfo">
        <nav>
            <span class="span0"><strong>배송정보</strong>(가입시 입력한 회원 정보를 기준으로 기본값이 출력됩니다.)</span>
        </nav>
        <form action="/teamplay/process/order_process.php" method="POST">
            <table id="delinfoTable">
                <tr height='50px'>
                    <!--  member table에서 유저 정보 받아와 이름 자동으로 입력-->
                    <td><span class="span1">받으시는 분</span></td>
                    <td>
                        <input type="text" value=<?=$row2['name']?>>
                    </td>
                </tr>
                <tr height='110px'>
                    <td><span class="span1">주소</span></td>
                    <td>
                        <input type="text" id="sample6_postcode" class="address" placeholder="우편번호" name="addr1">
                        <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기" class="notice ididen" style="width:10%">
                        <p><input type="text" id="sample6_address" class="address" placeholder="주소" style="width:50%"name="addr2"></p>
                        <p><input type="text" id="sample6_detailAddress" class="address" placeholder="상세주소"class="notice" style="width:50%" name="addr3"></p>
    <!-- {$_POST["addr1"]}{$_POST["addr2"]}{$_POST["addr3"]} -->
                    </td>
                </tr>
                <tr height='50px'>
                    
                    <td><span class="span1">전화번호</span></td>
                    <td>
                        <!-- member table에서 유저 정보 받아와 전화번호 자동으로 입력 -->
                        <input type="text" name="inputtel" id="inputtel" value=<?=$row2['tel']?>>
                        <span class="notice"> -없이 입력</span>
                    </td>
                </tr>
                <tr height='80px'>
                    <td><span class="span1">이메일</span></td>
                    <td>
                        <input type="text" require> 
                        <span class="span2"> @ </span> 
                        <input id="emailsel" type="text" require>
                        <select name="useremail" id="emailselect">
                            <option value="naver.com">naver.com</option>
                            <option value="google.com">google.com</option>
                            <option value="daum.com">daum.net</option>
                            <option value="nate.com">nate.com</option>
                        </select>
                        <p class="emailinfo">이메일을 통해 주문처리과정을 보내드립니다.</p>
                    </td>
                </tr>
                <tr height='110px'>
                    <td><span class="span1">배송메세지</span></td>
                    <td>
                        <textarea name="" id="" cols="30" rows="10" placeholder="배송관련 요청사항을 작성해주세요"></textarea>
                    </td>
                    <td>
                        <input type="hidden" name="quantity" value=<?=$_GET['quantity']?>>
                        <input type="hidden" name="productcode" value=<?=$_GET['productcode']?>>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div id="orderbtn2">
        <button href="">주문하기</button>
    </div>
</div>
<?php
    include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php"
?>

<!-- kakao 주소검색 script -->
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
        let emailSel = document.querySelector("#emailsel");
        let emailSelect = document.querySelector("#emailselect");

        emailSelect.addEventListener('change',(event) => {
            emailSel.value = event.target.value
        });

    function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    //document.getElementById("sample6_extraAddress").value = extraAddr;
                
                } else {	
                    //document.getElementById("sample6_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample6_postcode').value = data.zonecode;
                document.getElementById("sample6_address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("sample6_detailAddress").focus();
            }
        }).open();
    }
// kakao 주소검색 script 끝

// 주문 가격 부분
    const checkinputs = document.querySelectorAll('.cartcheck');
    let totalprice = 0;
    let totaldel = 0;
    let totaltal = 0;
    checkinputs.forEach(ch=>{
        ch.addEventListener('click',totalpriceF);
    })
    function totalpriceF(){
        totalprice= 0;
        totaldel = 0;
        totaltal = 0;
        checkinputs.forEach(ch=>{
            if(ch.checked){
                const{price,del,quan} = ch.dataset;
                totalprice += price*quan;
                totaldel = Number(del);
            }
        })
        totaltal = totalprice + totaldel;
        // 상품 구매 가격이 100000원 이상일 때 배송비 무료
        // if(totaltal > 100000) {
        //     totaldel = 0;
        // }
        document.querySelector('#productprice').innerHTML = totalprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        document.querySelector('#delprice').innerHTML = totaldel;
        document.querySelector('#totalprice').innerHTML = `${totaltal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')}원`;
    }
    totalpriceF();

    //맨 위 체크박스 클릭하면 전체 선택 / 선체 선택 해제
    function allselect(allselect) {
        const checkboxes = document.getElementsByName('product');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = allselect.checked;
        })
        totalpriceF();
    }

    // 이전페이지 버튼 누르면 전 페이지로 돌아가기
    const prev = document.querySelector(".prevpage");
    prev.addEventListener("click", function() {
        history.back();
    })
    // 주문버튼누르면 전체상품 주문테이블로 넘기기
    let alldelbtn = document.querySelector("#orderbtn2 button")
    alldelbtn.addEventListener('click',function(){
        let address = "";
        document.querySelectorAll(".address").forEach(add=>{
            address += add.value;
        })
        let order = document.querySelectorAll("#orderTable tbody tr");
        order.forEach(row=>{
            let quantity = row.querySelector(".quantity").innerHTML;
            let productcode = row.querySelector(".productcode").value;
            console.log(quantity);
            console.log(productcode);
            console.log(address);
            async function cartdel(){
                try{
                    const res = await fetch(`http://corona0113.dothome.co.kr/teamplay/process/addorder_process.php`,{
                        method: "POST",
                        header: {
                            "Content-Type":"application/json",
                        },
                        body : JSON.stringify({
                            productcode: productcode,
                            quantity: quantity,
                            address: address,
                        })
                    });
                    const result = await res.text();
                    if(result == "yes"){
                        console.log("dd");
                        location.href="/teamplay/index.php";
                    }else{
                        console.log(result);
                    }
                }
                catch(e){
                    console.log(e)
                }
            }
            cartdel();
        })
    })


</script>

<?php    
}else{
?>
<script>
    location.replace( location.href="/teamplay/login.php");
</script>
<?php    
}
?>