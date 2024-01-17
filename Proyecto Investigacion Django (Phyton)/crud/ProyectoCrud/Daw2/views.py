from django.shortcuts import render, redirect

from Daw2.models import Estudiante


# Create your views here.

def home(request):
    estudiantes = Estudiante.objects.all()
    return render(request, "gestionEstudiantes.html", {"estudiantes": estudiantes})


def agregar_estudiante(request):
    nif = request.POST['txtNif']
    nombre_apellido = request.POST['txtNombre_apellido']
    edad = request.POST['txtEdad']
    carrera = request.POST['txtCarrera']
    universidad = request.POST['txtUniversidad']

    estudiante = Estudiante.objects.create(nif=nif, nombre_apellido=nombre_apellido, edad=edad, carrera=carrera,
                                           universidad=universidad)
    return redirect('/')


def eliminar_estudiante(request, nif):
    estudiante = Estudiante.objects.get(nif=nif)
    estudiante.delete()
    return redirect('/')


def editar_estudiante(request, nif):
    estudiante = Estudiante.objects.get(nif=nif)
    return render(request, "editarEstudiantes.html", {"nif": estudiante})


def formulario_editar_estudiante(request):
    nif = request.POST['txtNif']
    nombre_apellido = request.POST['txtNombre_apellido']
    edad = request.POST['txtEdad']
    carrera = request.POST['txtCarrera']
    universidad = request.POST['txtUniversidad']

    estudiante = Estudiante.objects.get(nif=nif)
    estudiante.nombre_apellido = nombre_apellido
    estudiante.edad = edad
    estudiante.carrera = carrera
    estudiante.universidad = universidad
    estudiante.save()

    return redirect('/')

