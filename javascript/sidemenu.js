// 클릭 했을 때 스크롤 이벤트 일어 날 리스트 지정
let lis = document.querySelectorAll(".scrollList");
// 화면 100% 높이 값을 wh에 지정
let wh = document.body.scrollHeight;
console.log(window.innerHeight);

// 클릭 이벤트 작성 (li를 클릭하면 스크롤 위치를 해당 위치로 이동)
for(let i = 0; i < lis.length; i++) {
    lis[i].addEventListener("click", function() {
        window.scrollTo({top: i * wh, behavior: "smooth"});
    })
}

// 스크롤 값에 따라 해당하는 li에게 클래스 on을 지정
document.addEventListener("scroll", function() {
    let sct = document.documentElement.scrollTop;
    console.log(sct);
    for(let i = 0; i < lis.length; i++) {
        if(sct >= wh * i && sct < wh * (i + 1)) {
            lis.forEach(li => li.classList.remove("on"));
            lis[i].classList.add("on");
        }
    }
})

