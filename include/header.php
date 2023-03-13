<?php 
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>유니버샵 | UNIVERSHOP</title>
    <link rel="shortcut icon" href="">
    <link rel="icon" type="image/png" sizes="32x32" href="/teamplay/image/favicon-32x32.png">
    <link rel="stylesheet" href="/teamplay/css/style.css">
    <script src="https://kit.fontawesome.com/a5fe8c9c01.js" crossorigin="anonymous"></script>
    <script  defer src="/teamplay/javascript/hiddenbanner.js"></script>
    <script defer src="/teamplay/javascript/sidemenu.js"></script>
</head>
<body>
    <div id="wrap">
        <header>
            <div id="header">
                <div id="logo"> 
                    <a href="/teamplay/index.php">
                        <img src="/teamplay/image/mainLogo.png" alt="">
                    </a>
                </div>
                <div id="searchBox">
                    <form action="/teamplay/search.php" method="get">
                        <input type="text" class="searchInput" name="searchInput">
                        <button type="submit"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div>
                    <ul id="headerList">
                        <?php  
                            if(isset($_SESSION['userid'])){
                        ?>
                            <li><a href="/teamplay/shop_cart.php">장바구니</a></li>
                            <li><a href="/teamplay/member/mypage.php">마이페이지</a></li>
                            <li><a href="/teamplay/process/logout_process.php">로그아웃</a></li>
                        <?php
                            }else{
                        ?>
                            <li><a href="/teamplay/login.php">장바구니</a></li>
                            <li><a href="/teamplay/member/mypage.php">마이페이지</a></li>
                            <li><a href="/teamplay/login.php">로그인</a></li>
                        <?php
                        }
                        ?>
                        <?php
                            if($_SESSION['userid'] == "lightning"){
                        ?>
                            <li><a href="/teamplay/update.php">제품정보 변경</a></li>
                            <li><a href="/teamplay/productlist.php">제품리스트</a></li>
                            <li><a href="/teamplay/productwrite.php">제품등록</a></li>
                        <?php  
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="menuBar">
                <div id="innerMenu">
                    <nav>
                        <i class="fa-sharp fa-solid fa-bars"></i>
                    </nav>
                    <ul id="mainList">
                        <li><a href="/teamplay/LIstview.php?brand=블리자드">블리자드 기획전</a></li>
                        <li><a href="/teamplay/LIstview.php?brand=리그오브레전드">리그 오브 레전드</a></li>
                        <li><a href="/teamplay/LIstview.php?brand=배틀그라운드">배틀그라운드</a></li>
                        <li><a href="/teamplay/LIstview.php?type=goods">게임 굿즈</a></li>
                    </ul>
                    </ul>
                    <div id="hiddenMenu">
                        <ul id="hiddenList">
                            <li>블리자드 기획전
                                <div class="subMenu">
                                    <ul class="subList">
                                        <li><a href="/teamplay/LIstview.php?cate=오버워치">오버워치</a></li>
                                        <li><a href="/teamplay/LIstview.php?cate=월드오브워크래프트">WoW</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>리그오브 레전드
                                <div class="subMenu">
                                    <ul class="subList">
                                        <li><a href="/teamplay/LIstview.php?cate=피규어">피규어</a></li>
                                        <li><a href="/teamplay/LIstview.php?cate=케이스">모바일ACC</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>배틀그라운드
                                <div class="subMenu">
                                    <ul class="subList">
                                        <li><a href="/teamplay/LIstview.php?cate=lifestyle">라이프스타일</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>게임 굿즈
                                <div class="subMenu">
                                    <ul class="subList">
                                        <li><a href="gotothehell"></a></li>
                                        <li><a href="gotothehell"></a></li>
                                        <li><a href="gotothehell"></a></li>
                                        <li><a href="gotothehell"></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="rightMenu">
                <ul>
                    <li><a href="/teamplay/search.php"><i class="fa-sharp fa-solid fa-magnifying-glass"></a></i></li>
                    <li><a href="/teamplay/shop_cart.php"><i class="fa-solid fa-cart-shopping"></a></i></li>
                    <li class="scrollList"><i class="fa-solid fa-chevron-up"></i></li>
                    <li class="scrollList"><i class="fa-solid fa-chevron-down"></i></li>
                </ul>
            </div>
        </header>
