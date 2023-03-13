<?php
   $conn= mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
   $password= password_hash($_POST["inputpw"],PASSWORD_DEFAULT);
    $sql="insert into member(name,id,pw,tel)
    values('{$_POST['inputname']}','{$_POST['inputid']}',
    '{$password}','{$_POST['inputtel']}')";
    $result=mysqli_query($conn,$sql);
    echo $sql;
        if($result){
    ?>
        <script>
            alert("회원가입 되었습니다.");
            location.replace("../login.php");
        </script>
        <?php
        }else{
            echo "실패";
        }
?>
