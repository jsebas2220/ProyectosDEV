/* 
2C = Two of Clubs
2D = Two of Diamonds
2H = Two of Hearts
2S = Two of Spades */

// crear variables para asignar arreglos con los valores de la baraja
let deck        = [];
const tipos       = ['C', 'D', 'H', 'S']
const especiales  = ['A', 'J', 'Q', 'K']
let puntosJugador = 0,
    puntosComputadora = 0;

//Referencias htmnl

const btnPedir = document.querySelector('#btnPedir');
const btnDetener = document.querySelector('#btnDetener');
const btnNuevo   = document.querySelector('#btnNuevo');


const divCartasJugador = document.querySelector('#jugador-cartas');
const divCartasCompu = document.querySelector('#computadora-cartas');

const puntosCompu = document.querySelectorAll('small');




// Crear nueva baraja
const crearDeck = () => {

    for (let i = 2; i <= 10; i++) {
        for (let tipo of tipos) {
            deck.push( i + tipo);
        }
    }

    for (let tipo of tipos){
        for (let esp of especiales){
            deck.push( esp + tipo )
        }
    }
   // console.log(deck);
    deck = _.shuffle(deck);
    console.log(deck);
    return deck;

}

crearDeck();

// Crear funcion para pedir carta
const pedirCarta = () => {
    if (deck.length === 0){
        throw 'No hay mas cartas en la baraja'
    }
    const carta = deck.pop();
    return carta;
}

/* pedirCarta(); */

const valorCarta = ( carta ) => {
    const valor = carta.substring(0, carta.length - 1);
    return ( isNaN (valor)) ? 
            (valor === 'A') ? 11 : 10
            : valor * 1;
}

// turo de la compu
const turnoComputadora = ( puntosMinimos ) => {

    do {
        const carta = pedirCarta();

        puntosComputadora = puntosComputadora + valorCarta( carta );
        puntosCompu[1].innerText = puntosComputadora;
        
        // <img class="carta" src="assets/cartas/2C.png">
        const imgCarta = document.createElement('img');
        imgCarta.src = `assets/cartas/${ carta }.png`; //3H, JD
        imgCarta.classList.add('carta');
        divCartasCompu.append( imgCarta );

        if( puntosMinimos > 21 ) {
            break;
        }

    } while(  (puntosComputadora < puntosMinimos)  && (puntosMinimos <= 21 ) );

    setTimeout(() => {
        if( puntosComputadora === puntosMinimos ) {
            alert('Nadie gana :(');
        } else if ( puntosMinimos > 21 ) {
            alert('Computadora gana')
        } else if( puntosComputadora > 21 ) {
            alert('Jugador Gana');
        } else {
            alert('Computadora Gana')
        }
    }, 100 );
}


// Eventos 
btnPedir.addEventListener('click', () => {

     const carta = pedirCarta();
     puntosJugador = puntosJugador + valorCarta(carta);
     puntosCompu[0].innerText = puntosJugador; 
     console.log(puntosJugador);
      
     //<img class="carta" src="assets/cartas/10C.png" alt="">
     const imgCarta = document.createElement('img');
     imgCarta.src = `assets/cartas/${carta}.png`;
     imgCarta.classList.add('carta');
     divCartasJugador.append(imgCarta);

     if ( puntosJugador > 21){
         console.error('perdiste');
         btnPedir.disabled = true;
         btnDetener.disabled = true;
         turnoComputadora(puntosJugador);
     }else if ( puntosJugador === 21){
         console.warn('21, Ganaste!')
         btnPedir.disabled = true;
         btnDetener.disabled = true;
         turnoComputadora(puntosJugador);
     }
});

btnDetener.addEventListener('click', () => {
    btnPedir.disabled   = true;
    btnDetener.disabled = true;

    turnoComputadora( puntosJugador );
});


btnNuevo.addEventListener('click', () => {

    console.clear();
    deck = [];
    deck = crearDeck();

    puntosJugador     = 0;
    puntosComputadora = 0;
    
    puntosCompu[0].innerText = 0;
    puntosCompu[1].innerText = 0;

    divCartasCompu.innerHTML = '';
    divCartasJugador.innerHTML = '';

    btnPedir.disabled   = false;
    btnDetener.disabled = false;

});


