//Encontrar el máximo de un array de 5 enteros (no usar Math.max).

let maximo = [1, 4, 6, 2, 9, 12, 2, 1, 3];
let auxiliarMax = 0;

for (let i = 0; i < maximo.length; i++) {
	if (maximo[i] > auxiliarMax) {
		auxiliarMax = maximo[i];
	}
}
console.log(auxiliarMax);
