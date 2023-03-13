<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php'
?>

<div id="findid">
    <h2>아이디 찾기</h2>
    <div id="findid_border">
        <div id="findidDiv">
            <span class="span0"><strong>아이디 찾기</strong></span>
            <form action="/teamplay/process/findid_process.php" method="post">
                <p>
                    <span class="span1">이름</span>
                    <input type ="text" name="name">
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
        <div id="findid_go">
            <a href="/teamplay/login.php">로그인</a>
            <span> | </span>
            <a href="findpw.php">패스워드 찾기</a>
        </div>
    </div>
</div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php"
?>