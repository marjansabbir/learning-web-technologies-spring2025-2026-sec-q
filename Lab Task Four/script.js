var price = 1000;

var q = document.getElementById("qty");
var t = document.getElementById("total");

q.addEventListener("input", function(){

    var quantity = q.value;

    if(quantity < 0){
        quantity = 0;
        q.value = 0;
    }

    var total = price * quantity;

    t.value = total;

    if(total > 1000){
        alert("You are eligible for gift coupon");
    }

});