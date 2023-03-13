<?php
    if($_POST["pw"]==$_POST["pwch"]){
        //패스워드 암호화를 시켜서 저장
        $password = password_hash("{$_POST['pw']}",PASSWORD_DEFAULT);
        $conn = mysqli_connect("localhost","corona0113","kimdh991!","corona0113");
        $sql = "update member set pw = '{$password}'
        where id = '{$_POST['id']}'";
        $result = mysqli_query($conn,$sql);
        if($result){
            ?>
            <script>
                //패스워드 변경
                alert("pw가 변경되었습니다.");
                location.href="/teamplay/login.php";
            </script>
            <?php
        }else{
        ?>
        <script>
            //패스워드 변경 불가
            alert("패스워드 변경 불가");
            history.back();
        </script>
        <?php
        }
        echo $sql;
    }else{
        ?>
        <script>
            alert("패스워드와 패스워드 확인이 일치하지 않습니다.");
            history.back();
        </script>
        <?php
    }
?>