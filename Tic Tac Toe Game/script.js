let cells = document.querySelectorAll(".cell");
let statusText = document.getElementById("status");
let resetBtn = document.getElementById("reset");

let currentPlayer = "X";
let board = ["","","","","","","","",""];
let gameRunning = true;

let winPatterns = [
    [0,1,2],
    [3,4,5],
    [6,7,8],
    [0,3,6],
    [1,4,7],
    [2,5,8],
    [0,4,8],
    [2,4,6]
];

cells.forEach(function(cell){
    cell.addEventListener("click", cellClicked);
});

resetBtn.addEventListener("click", resetGame);

function cellClicked(){

    let index = this.getAttribute("data-index");

    if(board[index] != "" || !gameRunning){
        return;
    }

    board[index] = currentPlayer;
    this.innerText = currentPlayer;

    checkWinner();

    if(gameRunning){
        if(currentPlayer == "X"){
            currentPlayer = "O";
        }else{
            currentPlayer = "X";
        }

        statusText.innerText = "Player " + currentPlayer + " Turn";
    }
}

function checkWinner(){

    for(let i=0;i<winPatterns.length;i++){

        let a = winPatterns[i][0];
        let b = winPatterns[i][1];
        let c = winPatterns[i][2];

        if(board[a] == "" || board[b] == "" || board[c] == ""){
            continue;
        }

        if(board[a] == board[b] && board[b] == board[c]){
            gameRunning = false;
            statusText.innerText = "Player " + board[a] + " Wins!";
            cells[a].style.backgroundColor = "lightgreen";
            cells[b].style.backgroundColor = "lightgreen";
            cells[c].style.backgroundColor = "lightgreen";
            return;
        }
    }

    if(!board.includes("")){
        statusText.innerText = "It's a Draw!";
        gameRunning = false;
    }
}

function resetGame(){

    board = ["","","","","","","","",""];
    gameRunning = true;
    currentPlayer = "X";

    statusText.innerText = "Player X Turn";

    cells.forEach(function(cell){
        cell.innerText = "";
        cell.style.backgroundColor = "white";
    });
}