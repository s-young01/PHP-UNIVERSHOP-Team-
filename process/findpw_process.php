<?php
    $conn= mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql = "select * from member where id='{$_POST['id']}'";
    $result= mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        //연락처가 동일한지 체크
        if($row["tel"]==$_POST["tel"]){
            ?>
            <script>
                //비밀번호는 수정하기 페이지로 이동
                alert("ID와 연락처가 확인되었습니다.")
                location.href="/teamplay/member/editpw.php?id=<?=$row['id']?>";
            </script>
            <?php
        }else{
            ?>
            <script>
                //연락처를 확인해주세요 경고창출력
                alert("일치하는 연락처 정보가 없습니다.");
                histroy.back();
            </script>
            <?php
        }
    }
    else{
    ?>
    <script>
        //이름을 확인해주세요
        alert("ID를 확인해주세요")
        history.back();
    </script>
    <?php
    }
?>