// Pedir   usuario   y   contraseña.   Pedir   repetir   contraseña.   Si   coinciden,   poner   “clave
// guardada”. Si tras 3 intentos no ha repetido bien la contraseña, poner “ ¡Centrate!

let usuario = prompt("Introduce tu usuario");
let contraseña = prompt("Introduce tu contraseña");

if (contraseña === prompt("Repite tu contraseña")) {
	console.log("Clave guardada");
} else {
	for (let i = 0; i < 2; i++) {
		if (contraseña === prompt("Repite tu contraseña")) {
			console.log("Clave guardada");
			break;
		} else if (i === 1) {
			console.log("¡Centrate!");
		}
	}
}
