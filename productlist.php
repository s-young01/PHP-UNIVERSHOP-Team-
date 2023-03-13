<?php
session_start();
if($_SESSION['userid'] == "lightning"){
include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php'
?>
    <?php
        $conn = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113"); // sql과 연결해주는 끈
        $sql = "select * from shopproduction"; //select한 값을 리턴받음
        // $sql2 = "select * from member"; //user조회
        
        $result = mysqli_query($conn,$sql);
        // $result2 = mysqli_query($conn,$sql2);
        
        $list="";
        // $list2 ="";
        while($row=(mysqli_fetch_array($result))){ 
            $list = $list."
            <tr>
                <td><img src='{$row['imageurl']}'></td> 
                <td>{$row['productcode']}</td>
                <td><a href='update.php?productcode={$row['productcode']}'>{$row['name']}</a></td>
                <td>{$row['brand']}</td>
                <td>{$row['price']}원</td>
                <td>{$row['brief']}</td>
                <td>{$row['recommend']}</td>
            </tr>";
        }
        // while($row=(mysqli_fetch_array($result2))){
        //     $list2 = $list2."
        //         <tr>
        //             <td>{$row['name']}</td> 
        //             <td>{$row['id']}</td>
        //             <td>{$row['pw']}</td>
        //             <td>{$row['tel']}</td>
        //         </tr>
        //         ";
        // }
    ?>
    
    <div>
        <div>
            <h2>상품목록</h2>
            <table class="adminproductlist">
                <tr>
                    <th>상품사진</th>
                    <th>상품코드</th>
                    <th>상품이름</th>
                    <th>브랜드</th>                
                    <th>가격</th>
                    <th>상품소개</th>
                    <th>추천</th>
                </tr>
                <?=$list?>
            </table>    
        </div>
        <div>
            <h2>유저 목록</h2>
            <tr>
                <th>이름</th>
                <th>아이디</th>
                <th>패스워드</th>
                <th>전화번호</th>
            </tr>
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