package soltel;
import java.util.Scanner; 


public class leer {

    static Scanner sc = new Scanner(System.in);

    public int entero(String mensaje){
        Scanner sc = new Scanner(System.in); // Create an instance of the Scanner class
        System.out.println(mensaje);
        int entero = sc.nextInt();
        sc.close();
        return entero;
    }

    
}
