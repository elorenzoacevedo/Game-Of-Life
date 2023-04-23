var grid;
var innerGrid = [];
var score = 0;

window.onload = function(){
    score = 0;
}

/**
 * Configures the properties (rows & cols) of the game
 */
function configure(){
    let rows = document.getElementById("rows").value;
    let cols = document.getElementById("columns").value;
    document.getElementById("config").classList.add("hidden");
    if(cols > 50) {cols = 50;}
    initGrid(rows, cols);
}

/**
 * Draws the grid
 * @param {int} rows number of rows
 * @param {int} cols number of columns
 */
function initGrid(rows, cols){
    grid = document.getElementById("grid");
    innerGrid = [];

    for(let i = 0; i < rows; i++){
        innerGrid[i] = [];
        innerGrid[i][0] = newCell(true);
        for(let j = 0; j < cols-1; j++){
            innerGrid[i][j+1] = newCell(false);
        }
    }

    document.getElementById("buttons").classList.remove("hidden");
    document.getElementById("pat").classList.remove("hidden");
}

/**
 * Creates a new cell in the grid
 * @param {boolean} newRow if the current cell represents a new row
 */
function newCell(newRow){
    let cell = document.createElement("div");
    cell.classList.add("cell");
    cell.classList.add("dead");
    cell.onmousedown = switchCellState;
    cell.onmouseover = drag;
    if(newRow){
        cell.classList.add("clear");
    }
    grid.append(cell);
    return cell;
}

let state = "";
let mouseDown = false; 

window.onmouseup = function(){
    mouseDown = false;
    state = "";
}

/**
 * Turns a cell alive if dead, and viceversa
 */
function switchCellState(){
    mouseDown = true;
    if(this.classList.contains("alive")){
        this.classList.remove("alive");
        this.classList.add("dead");
        state = "dead";
    }
    else {
        this.classList.add("alive");
        this.classList.remove("dead");
        state = "alive";
    }
}

/**
 * Implements the drag functinality to switchCellState
 */
function drag(){
    if(mouseDown){
        if(state == "alive"){
            this.classList.remove("dead");
            this.classList.add("alive");
        }
        else {
            this.classList.remove("alive");
            this.classList.add("dead");
        }
    }
}

/**
 * Clears the grid (duh)
 */
function clearGrid(){
    let cells = grid.children;
    for(let i = 0; i < cells.length; i++){
        cells[i].classList.remove("alive");
        cells[i].classList.add("dead");
    }
}

/**
 * Generates a 2D array
 * @param {int} row row count
 * @param {int} column column count
 * @returns the generated array
 */
function gridGeneration(row, column) {
    let arrGridGen = new Array(row);
    for (let i = 0; i < row; i++) {
        arrGridGen[i] = new Array(column).fill(0);
    }
    return arrGridGen;
}

var containsAlive = false;

function cellsAroundFun() {
    let rows = innerGrid.length;
    let cols = innerGrid[0].length;
    let storeCellCount = gridGeneration(rows, cols);
    containsAlive = false;

    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
            if(innerGrid[i][j].classList.contains("alive")){
                containsAlive = true;
            }

            let counter = 0;

            if (innerGrid[(i + 1) % rows][(j + 1) % cols].classList.contains("alive")) {
                counter++;
            }
            if (innerGrid[(i + 1) % rows][j].classList.contains("alive")) {
                counter++;
            }
            if (innerGrid[(i + 1) % rows][(j - 1 + cols) % cols].classList.contains("alive")) {
                counter++;
            }
            if (innerGrid[i][(j + 1) % cols].classList.contains("alive")) {
                counter++;
            }
            if (innerGrid[i][(j - 1 + cols) % cols].classList.contains("alive")) {
                counter++;
            }
            if (innerGrid[(i - 1 + rows) % rows][(j + 1) % cols].classList.contains("alive")) {
                counter++;
            }
            if (innerGrid[(i - 1 + rows) % rows][j].classList.contains("alive")) {
                counter++;
            }
            if (innerGrid[(i - 1 + rows) % rows][(j - 1 + cols) % cols].classList.contains("alive")) {
                counter++;
            }

            storeCellCount[i][j] = counter;
        }
    }

    return storeCellCount;
}

function gameProgress() {
    let cellsAround = cellsAroundFun();
    if(containsAlive){
        updateScore();
    }

    for (let i = 0; i < innerGrid.length; i++) {
        for (let j = 0; j < innerGrid[0].length; j++) {
            if (innerGrid[i][j].classList.contains("alive")) {
                if (cellsAround[i][j] < 2 || cellsAround[i][j] > 3) {
                    innerGrid[i][j].classList.remove("alive");
                    innerGrid[i][j].classList.add("dead");
                }
            } 
            else {
                if (cellsAround[i][j] == 3) {
                    innerGrid[i][j].classList.remove("dead");
                    innerGrid[i][j].classList.add("alive");
                }
            }
        }
    }
}

function advanceTwentyThreeGen(){
    for(let i = 0; i < 23; i++){
        gameProgress();
    }
}

let intervalID;
let playing;

function startGame(){
    if(!playing){
        intervalID = setInterval(gameProgress, 300);
        playing = true;
    }
}

function stopGame(){
    if(playing){
        clearInterval(intervalID);
        playing = false;
    }
}

function setPattern(){
    innerGrid = null;
    stopGame();
    restartScore();
    while(grid.firstChild){
        grid.removeChild(grid.lastChild);
    }
    let pattern = document.getElementById("pat").value;
    switch(pattern){
        case "":
            initGrid(10, 10);
            break;
        case "beehive": 
            createBeehive();
            break;
        case "blinker":
            createBlinker();
            break;
        case "toad":
            createToad();
            break;
        case "pulsar":
            createPulsar();
            break;
        case "lightweight_spaceship":
            createLightweightSpaceship();
            break;
    }
}

function createBeehive(){
    initGrid(5, 6);
    let plots = [[1,2], [1,3], [2,1], [2,4], [3,2], [3,3]];
    plots.forEach(element => {
        innerGrid[element[0]][element[1]].classList.add("alive");
        innerGrid[element[0]][element[1]].classList.remove("dead");
    });
}

function createBlinker(){
    initGrid(5, 5);
    let plots = [[1,2], [2,2], [3,2]];
    plots.forEach(element => {
        innerGrid[element[0]][element[1]].classList.add("alive");
        innerGrid[element[0]][element[1]].classList.remove("dead");
    });
}

function createToad(){
    initGrid(6, 6);
    let plots = [[2,2], [2,3], [2,4], [3,1], [3,2], [3,3]];
    plots.forEach(element => {
        innerGrid[element[0]][element[1]].classList.add("alive");
        innerGrid[element[0]][element[1]].classList.remove("dead");
    });
}

function createPulsar(){
    initGrid(17,17);
    let plots = [[2,4], [2,5], [2,6], [2,10], [2,11], [2,12], [4,2], [4,7], [4,9], [4,14],
                [5,2], [5,7], [5,9], [5,14], [6,2], [6,7], [6,9], [6,14], [7,4], [7,5],
                [7,6], [7,10], [7,11], [7,12], [9,4], [9,5], [9,6], [9,10], [9,11], [9,12],
                [10,2], [10,7], [10,9], [10,14], [11,2], [11,7], [11,9], [11,14], [12,2], [12,7],
                [12,9], [12,14], [14,4], [14,5], [14,6], [14,10], [14,11], [14,12]];
    plots.forEach(element => {
        innerGrid[element[0]][element[1]].classList.add("alive");
        innerGrid[element[0]][element[1]].classList.remove("dead");
    });
}

function createLightweightSpaceship(){
    initGrid(10, 20);
    let plots = [[1,3], [1,4], [2,2], [2,3], [2,4], [2,5], [3,2], [3,3], [3,5], [3,6], [4,4], [4,5]];
    plots.forEach(element => {
        innerGrid[element[0]][element[1]].classList.add("alive");
        innerGrid[element[0]][element[1]].classList.remove("dead");
    });
}

function updateScore(){
    let scoredom = document.getElementById("score");
    score++;
    scoredom.innerHTML = "Score: " + score;
}

function restartScore(){
    let scoredom = document.getElementById("score");
    score = 0;
    scoredom.innerHTML = "Score: " + score;
}

function cookieScore(){

    document.cookie = "score=" + score;
}