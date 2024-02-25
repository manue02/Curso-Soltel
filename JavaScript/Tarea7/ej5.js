// Define un array de num elementos. Imprimir elementos de índice impar.

let pares = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let i = 0;

while (i < pares.length) {
	if (i % 2 === 0) {
		console.log(`Número en la posición ${i}: ${pares[i]}`);
	}
	i++;
}
