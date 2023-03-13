<?php
    //입력받은 아이디가 있나 검사
    $conn= mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql= "select * from member where id ='{$_POST['id']}'";
    $result= mysqli_query($conn,$sql);
    //조건을 걸어준다
    //아이디가 있는지
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_array($result);
        //비밀번호가 일치하는지 
        
        if(password_verify($_POST["pw"],$row["pw"])){
            session_start();
            $_SESSION['userid']= $_POST["id"];
        }else{
        ?>
        <script>
            alert("ID혹은 비밀번호가 틀렸습니다.");
            histroy.back();
        </script>
        <?php
        }
        if(isset($_SESSION['userid'])){
        ?>
            <script>
                alert("환영합니다 ");
                location.replace("/teamplay/index.php");
            </script>
        <?php
        }else{
            echo "세션이 없습니다.";
            ?>
            <script>
                history.back();
            </script>
            <?php
        }
    }else{
?>
    <script>
        alert("ID혹은 비밀번호가 틀렸습니다.");
        history.back();
    </script>
<?php
}
?>