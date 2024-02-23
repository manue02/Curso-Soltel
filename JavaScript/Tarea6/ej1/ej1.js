// 1. Pedir la edad a un usuario. Si es menor de 18 años, pondrá “Al cole,” si tiene justo 18
// años, “Bienvenido/a a la mayoría de edad”, y si tiene 18 años o mas, pero menos de 65
// años, “Puedes trabajar”.

let num1 = prompt("Escribe la edad", 0);

if (num1 < 18) {
	console.log("Al cole");
} else if (num1 == 18) {
	console.log("Bienvenido/a a la mayoría de edad");
} else if (num1 >= 18 && num1 < 65) {
	console.log("Puedes trabajar");
}
