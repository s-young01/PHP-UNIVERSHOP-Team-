<?php
    $conn= mysqli_connect("localhost","corona0113","kimdh991!","corona0113");
    $sql = "select * from member where name='{$_POST['name']}'";
    $result= mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        //연락처가 동일한지 체크
        if($row["tel"]==$_POST["tel"]){
            ?>
            <script>
                //고객님의 ID는~~입니다 출력
                alert("고객님의 ID는<?=$row['id']?>입니다.");
                location.href="/teamplay/login.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                //연락처를 확인해주세요 경고창출력
                alert("일치하는 연락처 정보가 없습니다.");
                history.back();
            </script>
            <?php
        }
    }
    else{
    ?>
    <script>
        //이름을 확인해주세요
        alert("이름을 확인해주세요")
        history.back();
    </script>
    <?php
    }
?>