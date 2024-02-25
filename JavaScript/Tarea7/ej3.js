// Variables   esVerano   y   temperatura.   Si   es   verano   y   la   temperatura   es
// mayor   de   25º,   poner   “Nos   vamos   a   Islantilla”.   Inventar   2   casos
// adicionales y sus mensajes

let esVerano = true;
let temperatura = 10;

if (temperatura > 25) {
	console.log("Nos   vamos   a   Islantilla");
} else if (esVerano === false && temperatura <= 25) {
	console.log("Nos quedamos en casa");
} else {
	console.log("No es verano");
}
