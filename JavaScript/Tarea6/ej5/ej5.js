// Dime la suma de todos los pares y de los impares entre 1 y 100

let sumaPar = 0;
let sumaImpar = 0;

for (let i = 1; i <= 100; i++) {
	if (i % 2 === 0) {
		sumaPar += i;
	} else {
		sumaImpar += i;
	}
}

console.log("Esto es la suma par -> " + sumaPar);
console.log("Esto es la suma impar -> " + sumaImpar);
