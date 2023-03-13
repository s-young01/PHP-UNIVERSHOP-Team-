// 숨긴 전체메뉴바 
const nav=document.querySelector("nav");
const hiddenbox =  document.querySelector("#hiddenMenu");
nav.addEventListener("mouseenter",function(){
    hiddenbox.style="display: block;" ;
})
nav.addEventListener("mouseleave",function(){
    hiddenbox.style="display: none;" ;
})
hiddenbox.addEventListener("mouseenter",function(){
    hiddenbox.style="display: block;" ;
})
hiddenbox.addEventListener("mouseleave",function(){
    hiddenbox.style="display: none;" ;
    })
