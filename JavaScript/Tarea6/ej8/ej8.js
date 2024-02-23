// Pirámide de * con tantos niveles como el número pedido al usuario
let numeroUsuario = 5;

for (let i = 0; i < numeroUsuario; i++) {
	let asteriscos = "";
	for (let x = 0; x <= i; x++) {
		asteriscos += " * ";
	}
	console.log(asteriscos);
}
