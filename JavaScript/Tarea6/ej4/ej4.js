// Pedir un arrray (1 alert por elemento) y mostrarlo al revés ¡SIN usar reverse!

let numeros = [1, 2, 3, 4, 5, 5, 6, 7];

for (let [index] of numeros.entries()) {
	console.log(numeros[numeros.length - 1 - index]);
	console.log(numeros[5]);
}
