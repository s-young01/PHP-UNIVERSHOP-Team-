<?php
    session_start();
    $result = session_unset();
    if($result){
        // header("Location: ../index.php");
?>
    <script>
        alert("로그아웃 되었습니다.");
        location.href="/teamplay/index.php"
    </script>
<?php
    }
?>