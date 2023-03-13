<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php'
?>

<div id="findpw">
    <h2>비밀번호 찾기</h2>
    <div id="findpw_border">
        <div id="findpwDiv">
            <span class="span0"><strong>비밀번호 찾기</strong></span>
            <form action="/teamplay/process/findpw_process.php" method="post">
                <p>
                    <span class="span1">아이디</span>
                    <input type ="text" name="id">
                </p>
                <p>
                    <span class="span2">연락처</span> 
                    <input type="text" name= "tel">
                </p>
                <nav>
                    <button type="submit" class="findbtn btn8">찾기</button>
                    <button type="reset" class="cancelbtn btn8">취소</button>
                </nav>
            </form>
        </div>
        <div id="findpw_go">
            <a href="/teamplay/login.php">로그인</a>
            <span> | </span>
            <a href="findid.php">아이디 찾기</a>
        </div>
    </div>
</div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php"
?>