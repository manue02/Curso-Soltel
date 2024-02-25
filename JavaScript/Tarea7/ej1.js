// Definir las variables edad y carneConducir. Poner los mensajes “Eres menor”, “Te falta
// el carné”, “Puedes conducir

let edad = 10;
let carneConducir = false;

if (edad < 18) {
	console.log("Eres menor");
} else if (edad >= 18 && carneConducir === true) {
	console.log("Puedes conducir");
} else {
	console.log("Te falta el carne");
}
