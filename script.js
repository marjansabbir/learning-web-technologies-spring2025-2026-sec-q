console.log("JS Connected");

let display = document.getElementById("display");
let buttons = document.getElementsByClassName("btn");

for(let i = 0; i < buttons.length; i++){

    buttons[i].addEventListener("click", function(){

        display.value = display.value + this.value;

    });

}

let clearBtn = document.getElementById("clear");

clearBtn.addEventListener("click", function(){
    display.value = "";
});

let equalBtn = document.getElementById("equal");

equalBtn.addEventListener("click", function(){

    if(display.value == ""){
        return;
    }

    let result = eval(display.value);
    display.value = result;

});