const consoleBtn = document.querySelector(".console");
const goodsBtn = document.querySelector(".goods");
let firstList = document.querySelector(".best5List");
let secondList = document.querySelector(".best5List2");

// 콘솔버튼 클릭했을 때 두번째 리스트
consoleBtn.addEventListener("click", function() {
    firstList.style = "display:flex";
    secondList.style = "display:none";
})

// 굿즈버튼 클릭했을 때 첫번째 리스트
goodsBtn.addEventListener("click", function() {
    firstList.style = "display:none";
    secondList.style = "display:flex";
})