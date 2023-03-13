
        <footer>
            <div id="graybox"></div>
            <div id="footerLine">
                <div id="bottomnav">
                    <ul>
                        <li><a href="#">회사소개</a></li>
                        <li><a href="#">이용약관</a></li>
                        <li><a href="#">개인정보취급방침</a></li>
                        <li><a href="#">이용안내</a></li>
                        <li><a href="#" id="partner">제휴문의</a></li>
                    </ul>
                    <ul>
                        <li><a href="#"><i class="fa-brands fa-google-play"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-discord"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                    </ul>
                </div>
            </div>
                <div id="footermid">
                    <div class="customer">
                        <h4>CUSTOMER CENTER</h4>
                        <P>000-1818-2828</P>
                        <P>월-금 9:00~18:00 / 점심시간 13:00~14:00 / 주말,공휴일 휴무</P>
                        <P>고객문의: seeyoung0949@naver.com<br/>제휴문의: lia8774@naver.com</P>
                    </div>
                    <div class="account">
                        <h4>ACCOUNT INFO</h4>
                        <p>하나 123-456787-558642</br>주식회사 되고싶다</p>
                        <select name="" id="bankaccount">
                            <option value="토스뱅크">토스뱅크</option>
                            <option value="카카오뱅크">카카오뱅크</option>
                            <option value="케이뱅크">케이뱅크</option>
                        </select>
                    </div>
                    <div class="favorite">
                        <h4>FAVORITE MENU</h4>
                        <ul>
                            <li><a href="/teamplay/login.php">로그인 / 회원가입</a></li>
                            <li><a href="#">관심상품</a></li>
                            <li><a href="/teamplay/shop_cart.php">장바구니</a></li>
                            <li><a href="#">주문조회</a></li>
                            <li><a href="/teamplay/member/mypage.php">마이페이지</a></li>
                        </ul>
                    </div>
                    <div class="return">
                        <h4>RETURN / EXCHANGE</h4>
                        <p>지구의어딘가 B1유니버샵</br>
                        자세한 교환반품물자 안내는 문의란 및 공지사항을 참고해주세요 <br/>반품 교환 싫어요</p>
                    </div>
                </div>
                <div id="bottomLine">
                    <div id="footerbottom">
                        <ul>
                            <li>
                                COMPANY : 
                                <span>주식회사(진) 유니버샵</span>
                            </li>
                            <li>
                                OWNER : 
                                <span>김동현,김민준,권세영</span>
                            </li>
                            <li>
                                BUSINESS LICENSE : 
                                <span>취득직전</span>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                ADDRESS : 
                                <span>005252 지구의 어딘가,유니버샵</span>
                            </li>
                            <li>
                                TEL : 
                                <span>010-1111-2222</span>
                            </li>
                            <li>
                                FAX : 
                                <span>02-333-4444</span>
                            </li>
                        </ul>
                        <P>COPYRIGHT@유니버샵(UNIVERSHOP)ALL RIGHTS RESERVED. HOSTING CAFE24 |DESIGNED By Kwonseeyoung</P>
                    </div>
                </div>
        </footer>
    </div>
    <script>
        document.querySelector("#bankaccount").addEventListener("change",function(e){
            document.querySelector(".account p").innerHTML=`${e.target.value} 123-456-7878`
        })
        document.querySelector("#partner").addEventListener("click",function(e){
            e.preventDefault();
            e.target.innerHTML = "여기로 연락주세요 010 5491 2645"
        })
    </script>
</body>
</html>