const increBtn = document.querySelector(".increbtn");
const decreBtn = document.querySelector(".decrebtn");
let amountInput = document.querySelector("#amount");
let totalPrice = document.querySelector(".price");
let priceInner = document.querySelector(".priceInner");
let hiddenamount = document.querySelector("#hiddenamount");
let orderamount = document.querySelector("#orderamount");

// 클릭 이벤트 
increBtn.addEventListener("click", function() {
    if(amountInput.value < 5) {
        amountInput.value++
        orderamount.value++
        hiddenamount.value++
        Price();
    } else {
        alert("최대 주문량은 5개 입니다.");
        return;
    }
    
})

decreBtn.addEventListener("click", function() {
    if(amountInput.value > 1) {
        amountInput.value--
        orderamount.value--
        hiddenamount.value-
        Price();
    } else {
        alert("최소 주문량은 1개 입니다.");
        return;
    }
})

// 회면에 가격에 input값 곱해서 띄워주는 함수
function Price() {
    let total = Number(totalPrice.innerHTML) * amountInput.value;
    let result = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    priceInner.innerHTML = `<strong>${result}</strong>`;
}