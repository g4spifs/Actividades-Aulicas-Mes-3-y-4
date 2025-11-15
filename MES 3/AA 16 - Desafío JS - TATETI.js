
function iniciarJuegoTateti() {

    // --- ESTADO DEL JUEGO ---
    let board = ['1', '2', '3', '4', '5', '6', '7', '8', '9']; // Muestra números para casillas vacías
    let currentPlayer = 'X';
    let gameActive = true;
    let gamePhase = 'placement'; // 'placement' o 'movement'
    let tokenCounts = { 'X': 0, 'O': 0 };

    const winningConditions = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Horizontales
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Verticales
        [0, 4, 8], [2, 4, 6]  // Diagonales
    ];

    // --- FUNCIONES PRINCIPALES ---

    /**
     * Dibuja el tablero actual en la consola.
     */
    function printBoard() {
        console.log('\n--- TA-TE-TI (3 FICHAS) ---');
        console.log(` ${board[0]} | ${board[1]} | ${board[2]} `);
        console.log('---+---+---');
        console.log(` ${board[3]} | ${board[4]} | ${board[5]} `);
        console.log('---+---+---');
        console.log(` ${board[6]} | ${board[7]} | ${board[8]} `);
        console.log('----------------\n');
    }

    /**
     * Revisa si el jugador actual ha ganado.
     */
    function checkWin() {
        for (const condition of winningConditions) {
            const [a, b, c] = condition;
            // Si las tres posiciones contienen la ficha del jugador actual, gana.
            if (board[a] === currentPlayer && board[b] === currentPlayer && board[c] === currentPlayer) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verifica si un movimiento de 'from' a 'to' es válido.
     * "Punto más cercano" = adyacente (horizontal o vertical).
     */
    function isValidMove(fromIndex, toIndex) {
        const fromRow = Math.floor(fromIndex / 3);
        const fromCol = fromIndex % 3;
        const toRow = Math.floor(toIndex / 3);
        const toCol = toIndex % 3;

        const rowDiff = Math.abs(fromRow - toRow);
        const colDiff = Math.abs(fromCol - toCol);

        // Es un movimiento válido si la distancia de Manhattan es 1
        // (Es decir, se mueve 1 en fila O 1 en columna, pero no ambos)
        return (rowDiff === 1 && colDiff === 0) || (rowDiff === 0 && colDiff === 1);
    }

    /**
     * Comprueba si una casilla está "vacía" (es decir, muestra un número).
     */
    function isCellEmpty(index) {
        return board[index] !== 'X' && board[index] !== 'O';
    }

    /**
     * Cambia el turno al otro jugador.
     */
    function switchPlayer() {
        currentPlayer = (currentPlayer === 'X') ? 'O' : 'X';
    }

    /**
     * Maneja la lógica de la Fase 1: Colocación de fichas.
     */
    function handlePlacementPhase() {
        let input = prompt(`Turno de ${currentPlayer} (Colocación). Elige una casilla (1-9):`);
        
        // Validar si es un número
        if (input === null) { // El usuario presionó Cancelar
             gameActive = false;
             console.log("Juego cancelado por el usuario.");
             return;
        }

        let index = parseInt(input) - 1;

        // Validación de la entrada
        if (isNaN(index) || index < 0 || index > 8) {
            console.log("Error: Debes ingresar un número del 1 al 9.");
            return; // Repite el turno
        }
        if (!isCellEmpty(index)) {
            console.log("Error: Casilla ocupada. Elige otra.");
            return; // Repite el turno
        }

        // Realizar jugada
        board[index] = currentPlayer;
        tokenCounts[currentPlayer]++;

        // Revisar estado del juego
        if (checkWin()) {
            gameActive = false;
            printBoard();
            console.log(`¡FELICIDADES! El jugador ${currentPlayer} ha ganado.`);
        } else {
            // Comprobar si la fase de colocación terminó
            if (tokenCounts['X'] === 3 && tokenCounts['O'] === 3) {
                gamePhase = 'movement';
                console.log("--- FASE DE COLOCACIÓN TERMINADA. COMIENZA EL MOVIMIENTO. ---");
            }
            switchPlayer();
        }
    }

    /**
     * Maneja la lógica de la Fase 2: Movimiento de fichas.
     */
    function handleMovementPhase() {
        // 1. Seleccionar ficha PROPIA
        let fromInput = prompt(`Turno de ${currentPlayer} (Movimiento). Elige TU FICHA para mover (1-9):`);
        
        if (fromInput === null) { // Cancelar
             gameActive = false;
             console.log("Juego cancelado por el usuario.");
             return;
        }
        
        let fromIndex = parseInt(fromInput) - 1;

        // Validación de 'desde'
        if (isNaN(fromIndex) || fromIndex < 0 || fromIndex > 8 || board[fromIndex] !== currentPlayer) {
            console.log("Error: Debes elegir una casilla que contenga una de tus fichas.");
            return; // Repite el turno
        }

        // 2. Seleccionar destino VACÍO y ADYACENTE
        let toInput = prompt(`Mover ${currentPlayer} de ${fromInput} a... (Elige casilla vacía y cercana):`);
        
        if (toInput === null) { // Cancelar
             gameActive = false;
             console.log("Juego cancelado por el usuario.");
             return;
        }

        let toIndex = parseInt(toInput) - 1;

        // Validación de 'hasta'
        if (isNaN(toIndex) || toIndex < 0 || toIndex > 8) {
            console.log("Error: Debes ingresar un número del 1 al 9.");
            return; // Repite el turno
        }
        if (!isCellEmpty(toIndex)) {
            console.log("Error: La casilla destino está ocupada.");
            return; // Repite el turno
        }
        if (!isValidMove(fromIndex, toIndex)) {
            console.log("Error: Movimiento inválido. Solo puedes mover a una casilla adyacente (no diagonal).");
            return; // Repite el turno
        }

        // Realizar movimiento
        board[fromIndex] = fromInput; // Dejar el número original (ej: '5') en la casilla vacía
        board[toIndex] = currentPlayer; // Mover la ficha

        // Revisar estado
        if (checkWin()) {
            gameActive = false;
            printBoard();
            console.log(`¡FELICIDADES! El jugador ${currentPlayer} ha ganado.`);
        } else {
            switchPlayer();
        }
    }

    // --- BUCLE PRINCIPAL DEL JUEGO ---
    console.log("¡Bienvenido al Ta-Te-Ti de 3 Fichas!");
    
    // El juego se ejecuta mientras 'gameActive' sea verdadero.
    // Usamos 'prompt' que detiene la ejecución, por lo que un 'while' simple funciona.
    while (gameActive) {
        printBoard(); // Muestra el tablero al inicio de cada turno
        
        if (gamePhase === 'placement') {
            handlePlacementPhase();
        } else {
            handleMovementPhase();
        }
    }

    console.log("--- Juego Terminado ---");
}

// Para iniciar el juego, descomenta o escribe la siguiente línea en la consola:
// iniciarJuegoTateti();