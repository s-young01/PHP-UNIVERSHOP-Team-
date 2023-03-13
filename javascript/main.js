console.log(1);
const imglists = document.querySelector("#imglists");
const prevBtn = document.querySelector("#prevbtn");
const nextBtn = document.querySelector("#nextbtn");
const indiDiv = document.querySelector("#indi");
let spanstr = "";
//setIntervar을 담을 변수
let timer;
//현재 보이는 div번호
let current = 1;

let prevNum;
let nextNum;

// 노드의 마지막 자식 요소 노드
let lastImg = imglists.lastElementChild;
// 노드의 첫번째 자식 요소 노드
let firstImg = imglists.firstElementChild;
// 노드 복사하기
let cloneFirst = firstImg.cloneNode(true);
let cloneLast = lastImg.cloneNode(true);
imglists.append(cloneFirst);
imglists.prepend(cloneLast);

// 슬라이더 이미지
const slidImgs = document.querySelectorAll("#imglists li");

let lastIndex = slidImgs.length - 1;

// 스타일 수정하기
imglists.style.width = (slidImgs.length) * 100 + "%";
imglists.style.left = -(current * 100) + "%";
slidImgs.forEach((img, index) => {
    img.style.width = (100 / slidImgs.length) + "%";
    img.style.left = `${index * (100 / slidImgs.length)}%`;
    // indigator 만들기
    spanstr = spanstr + `<span>${index}</span>`;
    // console.log(index);
});
// span 화면에 출력
indiDiv.innerHTML = spanstr;

// span선택해서 클래스 달아주기 
let indilists = document.querySelectorAll("#indi span");
indilists[0].classList.add("on");

//indigator 이벤트 연결 (클릭했을 때 클릭한 인덱스 이미지로 감)
indiDiv.addEventListener("click",function(e){
    let targetnum = Number(e.target.innerHTML);
    moveDiv(targetnum);
})

// indigator에 마우스 올렸을 때 / 땠을 때 
indiDiv.addEventListener("mouseenter",function(){
    stopIt();
})
indiDiv.addEventListener("mouseleave",function(){
    startIt();
})

// 버튼에 마우스 올렸을 때 / 땠을 때  
prevBtn.addEventListener("mouseenter",function(){
    stopIt();
})
nextBtn.addEventListener("mouseenter",function(){
    stopIt();
})
prevBtn.addEventListener("mouseleave",function(){
    startIt();
})
nextBtn.addEventListener("mouseleave",function(){
    startIt();
})

// 버튼을 클릭했을 때
prevBtn.addEventListener("click",function(){
    if(current>0){
        prevNum=current-1;
    }
    console.log(current);
    moveDiv(prevNum);
})
nextBtn.addEventListener("click",function(){
    if(current<4){
        nextNum = current+1
    }
    moveDiv(nextNum);
})

// 맨 앞으로 lists를 이동해주는 함수
function firstMove() {
    setTimeout(function() {
        imglists.style.transition = "0s";
        imglists.style.left = "0%";
        current = 0;
    }, 500); // 3번 이미지에서 바로 첫번째 이미지로 가는 시간 0.5s
}   
//제일처음일때 제일뒤로이동
function lastMove(){
    setTimeout(function(){
        imglists.style.transition = "0s";
        imglists.style.left = "-400%";
        current = 4;
    },500)
}
 
//lists를 이동시키는 함수
function moveDiv(divnum){
    imglists.style.transition = "0.5s";
    imglists.style.left = `${-(divnum * 100)}%`
    current= divnum;
    if(divnum >= 4) {
        console.log("마지막 이미지 입니다.");
        firstMove();
    }
    if(divnum <= 0){
        console.log("처음 이미지 입니다.");
        lastMove();
      }
    // lists움직일 때 indigator도 같이 움직여줌 
    indilists.forEach(indi=>{
        indi.classList.remove("on");
    })
    indilists[current].classList.add("on");
}
//자동이미지 전환 실행함수
function startIt(){
    //3초마다 moveDiv()실행
    if(timer) stopIt();
    timer = setInterval(function(){
        moveDiv(current + 1);
        //current 0 일때 =>1
        //current 1 일때 =>2
        //current 2 일때 =>3
        //current 3 일때 =>0
        // next = current === lastIndex ? 0 : current+1;
        // moveDiv(next);
        console.log(current);
    }, 3000);
}
startIt();

//자동이미지전환 정지함수
function stopIt(){
    clearInterval(timer);
}

//recommend 부분 슬라이드 함수
const recommendlist = document.querySelector(".recomProduct");
const recommendprev = document.querySelector("#recommendprev");
const recommendnext = document.querySelector("#recommendnext");
const recommendindi = document.querySelector("#recommendindi");
let recomspan ="";

let recom_timer;
let recom_current =1;
let recom_next = 0;
let recom_prev = 0;

for(let i=1;i<11;i++){
    eval(`var recom_img${i}=recommendlist.querySelector('li:nth-child(${i})')` )   
    eval(`var clone_recom_img${i}=recom_img${i}.cloneNode(true)`)
}
for(let i=1;i<6;i++){
   eval(`recommendlist.append(clone_recom_img${i})`);
}
for(let i=10;i>5;i--){
    eval(`recommendlist.prepend(clone_recom_img${i})`);
    
}


const recom_slide = document.querySelectorAll(".recomProduct li");

let recom_lastIndex = recom_slide.length/5 -1;

//스타일
let i= 0
recommendlist.style.width = (recom_slide.length)/5 *100 +"%";
recommendlist.style.left = -(recom_current*100)+"%";
recom_slide.forEach((img,index)=>{
    img.style.width = (100/recom_slide.length) +"%";
    img.style.left = `${index * (100/recom_slide.length)}%`;
    if(index % 5 == 0){
        recomspan = recomspan + `<span>${i}</span>`;
        i++
    }
})
recommendindi.innerHTML = recomspan;
//span 클래스
let recom_indilists = document.querySelectorAll("#recommendindi span");
recom_indilists[1].classList.add("on");

//indi 이벤트
recommendindi.addEventListener("click",function(e){
    let targetnum =Number(e.target.innerHTML);
    recom_moveDiv(targetnum);
})

// 리스트에 마우스 올렸을 때 / 땠을 때 
recom_slide.forEach(lis => lis.addEventListener("mouseenter", function() {
    recom_stopIt();
}))
recom_slide.forEach(lis => lis.addEventListener("mouseleave", function() {
    recom_startIt();
}))

// indigator에 마우스 올렸을 때 / 땠을 때 
recommendindi.addEventListener("mouseenter",function(){
    recom_stopIt();
})
recommendindi.addEventListener("mouseleave",function(){
    recom_startIt();
})

// 버튼에 마우스 올렸을 때 / 땠을 때  
recommendprev.addEventListener("mouseenter",function(){
    recom_stopIt();
})
recommendnext.addEventListener("mouseenter",function(){
    recom_stopIt();
})
recommendprev.addEventListener("mouseleave",function(){
    recom_startIt();
})
recommendnext.addEventListener("mouseleave",function(){
    recom_startIt();
})

// 버튼을 클릭했을 때
recommendprev.addEventListener("click",function(){
    if(recom_current > 0){
        recom_prev=recom_current - 1
    }
    recom_moveDiv(recom_prev);
})
recommendnext.addEventListener("click",function(){
    if(recom_current<2){
        recom_next=recom_current+1
    }
    recom_moveDiv(recom_next);
})

// 맨 앞으로 lists를 이동해주는 함수
function recom_firstMove() {
    setTimeout(function() {
        recommendlist.style.transition = "0s";
        recommendlist.style.left = "0%";
        recom_current = 0;
    }, 500); // 3번 이미지에서 바로 첫번째 이미지로 가는 시간 0.5s
}
function recom_lastMove(){
    setTimeout(function(){
        recommendlist.style.transition="0s"
        recommendlist.style.left = "-200%";
        recom_current = 2;
    },500)
}

// lists를 이동시키는 함수
function recom_moveDiv(divnum){
    recommendlist.style.transition = "0.5s";
    recommendlist.style.left = `${-(divnum * 100)}%`;
    recom_current = divnum;
    if(divnum >= 2){
        recom_firstMove();
    }
    if(divnum == 0){
        recom_lastMove();
    }
    recom_indilists.forEach(indi=>{
        indi.classList.remove("on");
    })
    recom_indilists[recom_current].classList.add("on");
    console.log(recom_current);
}

//자동이미지 전환 실행함수
function recom_startIt(){
    //3초마다 recom_moveDiv()실행
    if(recom_timer) stopIt();
    recom_timer = setInterval(function(){
        recom_moveDiv(recom_current + 1);
    }, 3000);
}
recom_startIt();

//자동이미지전환 정지함수
function recom_stopIt(){
    clearInterval(recom_timer);
}





