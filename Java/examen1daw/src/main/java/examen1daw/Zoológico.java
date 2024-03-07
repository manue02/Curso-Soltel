package examen1daw;

import java.util.ArrayList;
import java.util.List;

public class Zoológico
{
	private Mamífero tMamíferos[];
	private Veterinario tVeterinarios[];

	public Zoológico()
	{
		this.tVeterinarios = new Veterinario[0];
		this.tMamíferos = new Mamífero[0];
	}	

	public Mamífero[] gettMamíferos()
	{
		return tMamíferos;
	}

	public Veterinario[] gettVeterinarios()
	{
		return tVeterinarios;
	}

	public void añadeVeterinario(Veterinario veterinario)
	{
		Veterinario tNueva[] = new Veterinario[this.tVeterinarios.length+1];
		for(int i=0;i<this.tVeterinarios.length;i++){
			tNueva[i] = this.tVeterinarios[i];
		}
		tNueva[this.tVeterinarios.length] = veterinario;
		this.tVeterinarios = tNueva;
	}

	public void añadeMamífero(Mamífero mamífero)
	{
		Mamífero tNueva[] = new Mamífero[this.tMamíferos.length+1];
		for(int i=0;i<this.tMamíferos.length;i++){
			tNueva[i] = this.tMamíferos[i];
		}
		tNueva[this.tMamíferos.length] = mamífero;
		this.tMamíferos = tNueva;
	}

	public Mamífero[] getMamíferosEntreFechas(Fecha inicio, Fecha fin)
	{
		List<Mamífero> temporal = new ArrayList<Mamífero>();

		for(int y=0;y<this.tMamíferos.length;y++){
			if(this.tMamíferos[y].getdíaNacimiento().compareTo(inicio) >= 0 && this.tMamíferos[y].getdíaNacimiento().compareTo(fin) <= 0){
				
			 	temporal.add(this.tMamíferos[y]);
			}
		}

		Mamífero resultado[] = new Mamífero[temporal.size()];
		resultado = temporal.toArray(resultado);

		return resultado;
	}

	public int getNVeterinariosMasDe(int minNumNacimientos)
	{
		int contadorNacimientos = 0;
		int contadorNacimientosTotal = 0;

		for(int i=0;i<this.tVeterinarios.length;i++){

			contadorNacimientos = 0;
			
			for(int y=0;y<this.tMamíferos.length;y++){

				if(this.tVeterinarios[i].getNombre().equals(this.tMamíferos[y].getAsistente().getNombre())){

					contadorNacimientos++;
				}	
			}
			if (contadorNacimientos >= minNumNacimientos){

				contadorNacimientosTotal++;
			}
		}

		return contadorNacimientosTotal;
	}

	public boolean veterinarioPadresEHijo()
	{
	
		return false;
	}

	public boolean hayErroresEnFechas()
	{
		return false;
	}
}
