# Create your models here.

from django.db import models


class Estudiante(models.Model):
    nif = models.CharField(max_length=9, primary_key=True)
    nombre_apellido = models.CharField(max_length=50)
    edad = models.IntegerField()
    carrera = models.CharField(max_length=50)
    universidad = models.CharField(max_length=50)

    def __str__(self):
        return self.nombre_apellido
