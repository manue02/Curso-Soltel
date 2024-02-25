//Invertir una cadena (usar atributo cadena.length para tamaño cadena en caracteres).

let cadena = ["Murcielago", "Pato", "Caballo", "Cocodrilo"];

for (const iterator of cadena) {
	let i = 0;
	let inverso = "";

	while (i < iterator.length) {
		inverso = iterator[i] + inverso;
		i++;
	}
	console.log(inverso);
}
