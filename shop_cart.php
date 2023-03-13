<?php
    include_once "./include/header.php"
?>
<?php
    $conn=mysqli_connect("localhost","corona0113","kimdh991!","corona0113");
    $sql = "select shopproduction.imageurl , shopproduction.name, 
    shopproduction.price , shoppingcart.c_quantity, shoppingcart.c_no,
    shoppingcart.c_memberid, shopproduction.productcode
    from
    shopproduction inner join shoppingcart
    on shopproduction.productcode = shoppingcart.c_productcode
    where shoppingcart.c_memberid = '{$_SESSION['userid']}'
    ";
    $result = mysqli_query($conn,$sql);
    $list = "";
    $count = 0;
    while($row = (mysqli_fetch_array($result))){
        $count++;
        $totalProduct = number_format($row['price']*$row['c_quantity'],0,'.',',');
        $totaldelProduct = number_format($totaldelProduct+2500,0,'.',',');
        $deleprice = number_format(2500,0,'.',',');
        $price = number_format($row['price'],0,'.',',');
        $list = $list."
        <tr class='row'>
            <td>
                <label class='container'>
                    <input type='checkbox' checked='checked' class='cartcheck' name='product'
                    data-price='{$row['price']}'
                    data-del='2500'
                    data-quan='{$row['c_quantity']}'
                    >
                    <span class='checkmark'></span>
                </label>
            </td>
            <td>
                <img src='{$row['imageurl']}' alt=''>
            </td>
            <td><span class='span0'><a href='detailview.php?productcode={$row['productcode']}'>{$row['name']}</a></span></td>
            <td><strong class='price'>{$row['price']}</strong></td>
            <td>
                <div id='amountbox'>
                    <input type='text' name='amount' value='{$row['c_quantity']}' id='amount'>
                    <nav class='updownbtn'>
                        <button class='increbtn btn3'><i class='fa-solid fa-caret-up'></i></button>
                        <button class='decrebtn btn3'><i class='fa-solid fa-caret-down'></i></button>
                    </nav>
                </div>
            </td>
            <td><strong class='totalpricerow'>{$totalProduct}</strong></td>
            <td>
                <nav id='selecbtn'>
                    <button class='orderbtn btn5'>주문하기</button>
                    <button class='deletebtn btn5' data-no='{$row['c_no']}'
                    onclick = 'cartdel(this)'>
                    X 삭제</button>
                </nav> 
            </td>
        </tr>
        ";
    }
?>

<div id="shopcart">
    <div class="path">
        <ul>
            <li><a href="/teamplay/index.php">홈 </a></li>
            <li>&nbsp> 장바구니</li>
        </ul>
    </div>
    <h2>장바구니</h2>
    <ul id="prodcamount">
        <li>배송상품(<?=$count?>)</li>
    </ul>
    <table id="shopcartTable" class="cartList">
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
                <th width='10%'>판매가</th>
                <th width='10%'>수량</th>
                <th width='10%'>합계</th>
                <th width='20%'>선택</th>
            </tr>
        </thead>
        <tbody>
            <!-- 장바구니에 담긴 상품이 없을 때 화면 구현 -->
            <?php
                if($count == 0) {
            ?>
                    <tr id="noneproduct">
                        <td></td>
                        <td></td>
                        <td colspan='4'>
                            <ul>
                                <li><i class="fa-solid fa-cart-plus"></i></li>
                                <li>장바구니에 상품이 없습니다.</li>
                                <li>상품을 눌러 장바구니에 담아주세요.</li>
                            </ul>
                        </td>
                    </tr>
            <?php
                } else {
            ?>
                    <!-- 상품들어갈위치 -->
                    <?=$list?>
                    <!-- 상품들어갈위치 -->
            <?php  
                }
            ?>
            
        </tbody>
        <tfoot>
            <tr>
                <td colspan='7'>
                    <div class="totalorder">
                        <span>상품구매금액</span><strong id="productprice"> 45,000</strong>
                        <span> + 배송비 </span><span id="delprice">2,500</span>
                        <span>= 합계 : </span><strong id="totalprice">47,500원</strong>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
    <ul id="alldelete">
        <li>
            <span>전체상품을</span>
            <form action="/teamplay/process/cartdelall_process.php">
                <button class="alldeletebtn btn6">X 삭제하기</button>
            </form>
        </li>
    </ul>
    <div id="orderBtn">
        <nav>
            <form action="/teamplay/orderform.php" method="get">
                <input type="hidden" name="cartorder" value="1">
                <button type="submit" class="allorder btn7">전체상품주문</button>
            </form>
           
        </nav>
        <button class="continue">쇼핑계속하기 ></button>
    </div>
</div>
<script>
    const checkinputs = document.querySelectorAll('.cartcheck');
    const rows = document.querySelectorAll('.row')
    let totalprice = 0;
    let totaldel = 0;
    let totaltal = 0;
 
    checkinputs.forEach(ch=>{
        ch.addEventListener('change',totalpriceF);
    })
    function totalpriceF(rowquan){
        totalprice= 0;
        totaldel = 0;
        totaltal = 0;
        checkinputs.forEach(ch=>{
            if(ch.checked){
                let{price,del,quan} = ch.dataset;
                if(rowquan){
                    quan = rowquan
                }
                totalprice += price*quan;
                totaldel = Number(del);
            }
        })
        totaltal = totalprice + totaldel;
        // 상품 구매 가격이 100000원 이상일 때 배송비 무료
        // if(totalprice > 100000) {
        //     totaldel = 0;
        // }
        document.querySelector('#productprice').innerHTML = totalprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');;
        document.querySelector('#delprice').innerHTML = totaldel;
        document.querySelector('#totalprice').innerHTML = totaltal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');;
    }
    totalpriceF();
    async function cartdel(cartlist){
        const {no} = cartlist.dataset;
        try{
            const res = await fetch(`http://corona0113.dothome.co.kr/teamplay/process/cartdel_process.php`,{
                method: "POST",
                header: {
                    "Content-Type":"application/json",
                },
                body : JSON.stringify({
                    c_no: no
                })
            });
            const result = await res.text();
            if(result == "yes"){
                console.log("삭제");
                location.reload();
            }else{
                console.log(result);
            }
        }
        catch(e){
            console.log(e)
        }
    }
 
    //갯수버튼을 클릭하면 갯수가증가감소 하면서 총금액도 변경되도록
    rows.forEach(row=>{
        let quantity = row.querySelector('#amount');
        let price = Number(row.querySelector('.price').innerHTML);
        let totalpricerow = row.querySelector('.totalpricerow');
        let inputdataset = row.querySelector('.cartcheck').dataset
 
        row.querySelector('.increbtn').addEventListener('click',function(){
            // 최대 5개 까지 지정
            if(quantity.value < 5) {
                quantity.value++
            } else {
                alert("최대 주문 수량은 5개 입니다.");
            }
                inputdataset.quantity++
                totalpricerow.innerHTML = (price * quantity.value)
                totalpriceF(quantity.value)
        })
       
        row.querySelector('.decrebtn').addEventListener('click',function(){
            // 최소 1개 까지 지정
            if(quantity.value > 1) {
                quantity.value--
            } else {
                alert("최소 주문 수량은 1개 입니다.");
            }
                inputdataset.quantity--
                totalpricerow.innerHTML = (price * quantity.value)
                totalpriceF(quantity.value)
        })
       
 
    })
 
    //맨 위 체크박스 클릭하면 전체 선택 / 선체 선택 해제
    function allselect(allselect) {
        const checkboxes = document.getElementsByName('product');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = allselect.checked;
        })
        totalpriceF();
    }
 
</script>

<?php
    include_once "./include/footer.php"
?>