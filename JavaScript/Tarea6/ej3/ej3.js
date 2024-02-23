// Poner el DNI sin letra. La aplicación dirá cual es la letra:
// NOTA: Letras → ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X',
//  'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

let letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E", "T"];

// let numero = prompt("Introduce tu numero del DNI");

let numero = 12345678;
let division = numero % 23;

for (let [index, value] of letras.entries()) {
	if (division === index) {
		console.log(numero + value);
	}
}
