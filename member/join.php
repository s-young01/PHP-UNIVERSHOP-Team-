<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/teamplay/include/header.php'
?>
<main>
    <div class="join">
        <h2>회원가입</h2>
        <div id="joinForm">
            <form name="joinInfo" action="/teamplay/process/join_process.php" method="post" onsubmit="return false">
                <table id="joinTable">
                    <tr>
                        <th>
                            이름 |
                        </th>
                        <td>
                            <input type="text" name="inputname" id="inputname">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ID |
                        </th>
                        <td>
                            <input type="text" name="inputid" id="inputid">
                            <button class="ididen" onclick="Isidcheck()">중복확인</button>
                            <span class="notice" id="idnoti"> ( 영문소문자 / 숫자, 4~16자 )</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            비밀번호 |
                        </th>
                        <td>
                            <input type="password" name="inputpw" id="inputpw">
                            <span class="notice"> ( 영문 소문자 / 숫자 / 특수문자 중 2가지 이상 조합, 10자~16자 )</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            비밀번호재확인 |
                        </th>
                        <td>
                            <input type="password" name="inputpwch" id="inputpwch">
                            <span id="pwchnoti" class="notice"></span>
                        </td>
                    </tr>
                    <tr>   
                        <th>
                            연락처 |
                        </th>
                        <td>
                            <input type="text" name="inputtel" id="inputtel">
                            <span class="notice"> -없이 입력</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            우편번호 ㅣ
                        </th>
                        <td>
                            <input type="text" id="sample6_postcode" placeholder="우편번호">
                            <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기" class="notice ididen" style="width:20%">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                        <input type="text" id="sample6_address" placeholder="주소" disabled style="width:50%">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="text" id="sample6_detailAddress" placeholder="상세주소"class="notice" style="width:50%">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="joinBtn formBtn" onclick="formSubmit()">회원가입</button>
                            <button type= "reset" class="cancleBtn formBtn">취소</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</main>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>

let userid=document.querySelector("#inputid");
let userpw=document.querySelector("#inputpw");
let userpwch=document.querySelector("#inputpwch");
let usertel=document.querySelector("#inputtel");
let username=document.querySelector("#inputname");
let Ischecking =false;
let repeatcheck = document.querySelector(".ididen");
let pwchnoti = document.querySelector("#pwchnoti");

//비밀번호,비밀번호 재확인 확인하는 문자 출력
userpwch.addEventListener("keyup",pwch)
function pwch(){
    if(userpw.value==userpwch.value){
    pwchnoti.innerHTML="입력값이 동일합니다.";
    pwchnoti.style="color:#2b69ec";
}else{
    pwchnoti.innerHTML="입력값이 일치하지 않습니다.";
    pwchnoti.style="color:red";
    }
}
//ID중복 체크하는 함수
async function Isidcheck(){
    try{
        const res =await fetch(`http://corona0113.dothome.co.kr/teamplay/process/idcheck_process.php?id=${userid.value}`);
        const result = await res.text();
        if(!userid.value){
            alert("아이디를 입력해 주세요")
        }else{
            if(result=="yes"){
                alert("이미 등록된 ID입니다.");
            }else{
                alert(`사용가능한 ID 입니다.`);
                Ischecking = true;
            }   
        }
    }catch(e){
        console.log(e);
    }
}
function formSubmit(){
    if(Ischecking==true){
        // 숫자를 입력했는지 체크 num이 -1이 아니면 숫자가 있음
        let num = userpw.value.search(/[0-9]/g);
        // 영문자가 있는지 체크 -1이 아니면 있는거임
        let eng = userpw.value.search(/[a-z]/g);
        // 영어 대문자가 있는지 체크 -1이 아니면 있는거임
        let eng2 = userpw.value.search(/[A-Z]/g);
        // 특수문자 포함하고있는지 체크 -1이 아니면 있는거임
        let spe = userpw.value.search(/[~!@#$%^&*]/g);
        // 아이디에 한글 허용하지않음
        let kor = userid.value.search(/[[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]]/g);
        // 아이디에는 특수문자를 허용하지않음
        let idspe = userid.value.search(/[~!@#$%^&*]/g);
        // 이름에는 특수문자를 허용하지 않음
        let namespe = username.value.search(/[~!@#$%^&*]/g);
        // 연락처에는 숫자이외는 허용하지않음 
        let telnum = usertel.value.search(/[^\d]/g);
        if(!usertel.value || !userpwch.value || !userpw.value || !userid.value || !username.value){
            alert("빈칸이 존재합니다.");
            return false;
        }else if(usertel.value.search(/\s/)>0 || userpw.value.search(/\s/)>0 || userid.value.search(/\s/)>0 || username.value.search(/\s/)>0){
            alert("공백을 없애주세요");
            return false;
        }else if(namespe>=0){
            alert("이름에는 특수문자를 사용할수없습니다.");
            return false;
        }else if(kor >=0){
            alert("아이디는 한글을 사용할수없습니다.");
            return false;
        }else if(idspe>=0){
            alert("아이디는 특수문자를 사용할수없습니다.");
            return false;
        }else if(3>userid.value.length  && userid.value.length > 17){
            alert("ID를 4~16자 사이로 작성해주십시오");
            return false;
        }else if(9>userpw.value.length||userpw.value.length>17){
            alert("PW를 10~16자 사이로 작성해주십시오");
            return false;
        }else if(telnum >= 0){
            alert("연락처에 숫자이외 다른문자가 포함되었습니다.");
            return false;
        }
        else if(num < 0 || eng < 0 || spe < 0){
            alert("비밀번호는 영문소문자,숫자,특수문자를 혼합하여 입력해주세요");
            return false;
        }else if(userpw.value!==userpwch.value){
            alert("비밀번호와 재입력이 일치하지않습니다.")
            return false;
        }else if(Ischecking==false&&userid.value){
                alert("ID중복체크를 하지않았습니다.")
                return false;
        }else{
            document.joinInfo.submit();    
        }
    }



    // 숫자를 입력했는지 체크 num이 -1이 아니면 숫자가 있음
    let num = userpw.value.search(/[0-9]/g);
    // 영문자가 있는지 체크 -1이 아니면 있는거임
    let eng = userpw.value.search(/[a-z]/g);
    // 영어 대문자가 있는지 체크 -1이 아니면 있는거임
    let eng2 = userpw.value.search(/[A-Z]/g);
    // 특수문자 포함하고있는지 체크 -1이 아니면 있는거임
    let spe = userpw.value.search(/[~!@#$%^&*]/g);
    // 아이디에 한글 허용하지않음
    let kor = userid.value.search(/[[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]]/g);
    //
    if(!usertel.value || !userpwch.value || !userpw.value || !userid.value || !username.value){
        alert("빈칸이 존재합니다");
        return false;
    }else if(usertel.value.search(/\s/)>0 || userpw.value.search(/\s/)>0 || userid.value.search(/\s/)>0 || username.value.search(/\s/)>0){
        alert("공백을 없애주세요");
        return false;
    }else if(kor >=0){
        alert("아이디는 한글을 사용할수없습니다.");
        return false;
    }else if(3>userid.value.length  && userid.value.length > 17){
        alert("ID를 4~16자 사이로 작성해주십시오");
        return false;
    }else if(9>userpw.value.length||userpw.value.length>17){
        alert("PW를 10~16자 사이로 작성해주십시오");
        return false;
    }else if(num < 0 || eng < 0 || spe < 0){
        alert("비밀번호는 영문대소문자,숫자,특수문자를 혼합하여 입력해주세요");
        return false;
    }else if(userpw.value!==userpwch.value){
        alert("비밀번호와 재입력이 일치하지않습니다.")
        return false;
    }else if(Ischecking==false&&userid.value){
        alert("ID중복체크를 하지않았습니다.")
        return false;
    }else{
    alert("정보가 확인되었습니다");
    return false;
    }
}
function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    //document.getElementById("sample6_extraAddress").value = extraAddr;
                
                } else {	
                    //document.getElementById("sample6_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample6_postcode').value = data.zonecode;
                document.getElementById("sample6_address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("sample6_detailAddress").focus();
            }
        }).open();
    }
</script>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/teamplay/include/footer.php"
?>