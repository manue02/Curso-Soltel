//Haz una escalera de # pidiendo el nivel de peldaños.

let NumeroArmoadilla = 5;

for (let i = 0; i < NumeroArmoadilla; i++) {
	let asteriscos = "";
	for (let x = 0; x <= i; x++) {
		asteriscos += " # ";
	}
	console.log(asteriscos);
}
