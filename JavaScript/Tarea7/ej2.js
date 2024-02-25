// Pedir edad. Si tienes menos de 18, “No puedes trabajar”, entre 18 y 65
// (incluido), “Debes trabajar” y mas de 65 “Puedes jubilarte”.

let edad = 70;

if (edad <= 18) {
	console.log("No puedes trabajar");
} else if (edad >= 18 && edad <= 65) {
	console.log("Debes trabajar");
} else {
	console.log("Puedes jubilarte");
}
