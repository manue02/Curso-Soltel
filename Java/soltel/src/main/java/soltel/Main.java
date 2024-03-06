package soltel;


public class Main {

    public static leer lee = new leer();
    public static void main(String[] args) {
        
        System.out.println("Hello world!");
        int entero = lee.entero("Introduce Entero ->");
        System.out.println("Entero: " + entero);

        String cadena = """
                Hola
                Mundo
                con el nuevo 
                TextBlock
                """;

        System.out.println(cadena);

        String cadena2 = "Hola mundo";

        if(cadena2 instanceof String) {
            System.out.println("Cadena es de tipo STRING");
        } else {
            System.out.println("Cadena es de otro tipo...");
        }
    }
}