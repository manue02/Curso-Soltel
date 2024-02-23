#!/bin/bash
# Obtiene el nombre de la carpeta actual
folderName=${PWD##*/}

# Comprueba si la carpeta actual es "symfoni-soltel"
if [ "$folderName" = "symfony-soltel"]; then
  symfony server:start
else
  echo "No es la carpeta symfony-soltel. No se iniciará el servidor." 
  echo $folderName
fi

# Fin del script