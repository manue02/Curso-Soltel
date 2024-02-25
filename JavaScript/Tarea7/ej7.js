// Pedir un número. Mostrar múltiplos de ese número entre 1 y 50

let numero = 5;
let i = 1;

while (i <= 50) {
	if (i % numero === 0) {
		console.log(i);
	}

	i++;
}
