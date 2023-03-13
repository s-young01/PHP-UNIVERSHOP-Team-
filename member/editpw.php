<?php
    include_once "../include/header.php";
?>
<div>
    <h2>패스워드 변경</h2>
    <form action="../process/editpw_process.php" method="post">
        <input type="hidden" value="<?=$_GET['id']?>" name="id">
        <p>비밀번호 : <input type="password" name="pw"></p>
        <p>비밀번호 확인 : <input type="password" name="pwch"></p>
        <p>
            <button type="submit">찾기</button>
            <button type="reset">취소</button>
        </p>
    </form>
        <p>
            <button onclick="location.href='findid.php'">아이디 찾기</button>
            <button onclick="location.href='findpw.php'">비밀번호 찾기</button>
        </p>
    </form>
</div>
<?php
    include_once "../include/footer.php";
?>