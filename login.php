<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php'
?>
<div id="loginpage">
    <h2>LOGIN</h2>
    <div id="loginborder">
        <form action="./process/login_process.php" method="post">     
            <div id="inputs">
                <input type ="text" name="id" placeholder="ID"><br/>
                <input type="password" name= "pw" placeholder="PW">
                <nav class="loginbtn">
                    <button type="submit">로그인</button>
                </nav>
            </div>
                <nav class="forgot">
                <span class="span0"><a href="/teamplay/member/findid.php">아이디 찾기</a></span>
                <span> | </span>
                <span class="span0"><a href="/teamplay/member/findpw.php">비밀번호 찾기</a></span>
            </nav>
            <nav class="login_join">
                <button type="button" onclick="location.href='./member/join.php'">회원가입</button>
            </nav>
        </form>
    </div> 
</div>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php"
?>