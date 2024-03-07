package soltel;

public class Ej10_POO_Clases {

    // Metemos el leer
    //public static leer lee = new leer();

    // Definimos una clase
    public static class Camion {
        // Atributos de clase
        public String modelo = "Volvo FH Electric";
        public int potencia = 500;
        public boolean electrico = true;

        // 3 Constructores -> sobrecarga de métodos
        // Por defecto
        public Camion () {}

        // Definido
        public Camion (int potencia){
            this.potencia = potencia;
        }

        public Camion (String modelo, int potencia, boolean electrico){
            this.modelo = modelo;
            this.potencia = potencia;
            this.electrico = electrico;
        }

        // Otros métodos
        // 1. Para leer el objeto e instanciar
        public static Camion leerCamion() {
            String nuevoModelo = "modeloCualquiera";
            int nuevaPotencia = 20;
            boolean valorElectrico = true;
            return new Camion(nuevoModelo, nuevaPotencia, valorElectrico);
        }
        // 2. Para imprimir el objeto
        @Override
        public String toString() {
            return super.toString() + "\n" 
                + " modelo = " + this.modelo + "\n"
                + " potencia = " + this.potencia + "\n"
                + " Electrico = " + this.electrico + "\n";
        }
    }

    public static void main(String[] args) {
        Camion miCamion = new Camion();
        System.out.println(miCamion);
        // Hago otro camión
        //Camion otroCamion = Camion.leerCamion();
        System.out.println(Camion.leerCamion());
    }

}
