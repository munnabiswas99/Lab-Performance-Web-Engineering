let cells = document.querySelectorAll("td");
let currentPlayer = "X";
let board = Array(9).fill(null);
let gameActive = true;

function checkWinner() {
    const winPatterns = [
        [0,1,2], [3,4,5], [6,7,8], // rows
        [0,3,6], [1,4,7], [2,5,8], // cols
        [0,4,8], [2,4,6]           // diags
    ];
    for (let pattern of winPatterns) {
        const [a, b, c] = pattern;
        if (board[a] && board[a] === board[b] && board[a] === board[c]) {
            return board[a];
        }
    }
    return board.every(cell => cell) ? "Draw" : null;
}

cells.forEach((cell, idx) => {
    cell.addEventListener("click", function() {
        if (!gameActive || board[idx]) return;
        cell.textContent = currentPlayer;
        board[idx] = currentPlayer;
        let result = checkWinner();
        if (result) {
            gameActive = false;
            setTimeout(() => {
                alert(result === "Draw" ? "It's a draw!" : `${result} wins!`);
            }, 100);
                } else {
                    currentPlayer = currentPlayer === "X" ? "O" : "X";
                }
            });
        });