"""
URL configuration for ProyectoCrud project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/5.0/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path

from Daw2 import views

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', views.home, name="gestionEstudiantes"),
    path('añadirEstudiante/', views.agregar_estudiante, name="agregar_estudiante"),
    path('editarEstudiante/<nif>', views.editar_estudiante, name="editar_estudiante"),
    path('eliminarEstudiante/<nif>', views.eliminar_estudiante, name="eliminar_estudiante"),
    path('formularioEditarEstudiante/', views.formulario_editar_estudiante, name="formulario_editar_estudiante"),

]
