<?php
session_start();
if($_SESSION['userid'] == "lightning"){
include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php'
?>
<?php
    $conn = mysqli_connect("localhost","corona0113","kimdh991!","corona0113"); // sql과 연결해주는 끈
    $sql = "select * from shopproduction where productcode={$_GET['productcode']}"; //select한 값을 리턴받음
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
?>
<div id="adminpage">
    <h2>상품수정</h2>
    <form action="./process/update_process.php" method="post" enctype="multipart/form-data">
        <table class="adminupdate">
            <tr>
                <td>상품명</td>
                <td>
                    <input type="hidden" name="productcode" value=<?=$_GET['productcode']?>>
                    <input type="text" name="name" value="<?=$row['name']?>">
                </td>
            </tr>
            <tr>
                <td>브랜드</td>
                <td>
                    <select name="brand" id="brand">
                        <option value=<?=$row['brand']?>><?=$row['brand']?></option>
                        <option value="리그오브레전드">리그오브레전드</option>
                        <option value="오버워치">오버워치</option>
                        <option value="플레이스테이션">플레이스테이션</option>
                        <option value="닌텐도스위치">닌텐도스위치</option>
                        <option value="엑스박스">엑스박스</option>
                        <option value="블리자드">블리자드</option>
                        <option value="배틀그라운드">배틀그라운드</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>가격</td>
                <td>
                    <input type="text" name="price" value=<?=$row['price']?>>
                </td>
            </tr>
            <tr>
                <td>상품소개</td>
                <td>
                    <textarea name="brief" cols="20" rows="10"><?=$row['brief']?></textarea>
                </td>
            </tr>
            <tr>
                <td>상품사진</td>
                <td>
                    <img src=<?=$row['imageurl']?> alt="">
                    <input type="text" name="imageurl" value=<?=$row['imageurl']?>>
                </td>
            </tr>
            <tr>
                <td>추천상품</td>
                <td id="recommend">
                    <p>이전값 <?=$row['recommend']?></p>
                    <input type="radio" name="recommend" value="true">추천함
                    <input type="radio" name="recommend" value="false">추천X
                </td>
            </tr>
            <tr>
                <td>상품타입</td>
                <td>
                    <select name="type" id="type">
                        <option value=<?=$row[type]?>><?=$row[type]?></option>
                        <option value="console">console</option>
                        <option value="goods">goods</option>
                        <option value="gaminggear">gaminggear</option>
                        <option value="lifestyle">lifestyle</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>sales</td>
                <td>
                    <input type="text" name="sales" value=<?=$row['sales']?>>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">등록</button>
                    <button type="취소">취소</button>
                </td>
            </tr>
        </table>
    </form>
    <div>
        <form action="./process/delete_process.php" method="post">
            <input type="hidden" name="productcode" value=<?=$_GET['productcode']?>>
            <button type="submit"></button>
        </form>
    </div>
</div>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php";
}else{
?>
<script>
alert ("해당페이지는 관리자 전용페이지 입니다.")
location.replace( location.href="/teamplay/index.php");
</script>
<?php
}
?>