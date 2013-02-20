#!/bin/bash

php ../app/console doctrine:mapping:convert annotation ../src/CasavanaCO/BDBundle/config/doctrine/metadata/orm --from-database --force
echo "Base de datos mapeada: Pulse una tecla para continuar..."
read -s

php ../app/console doctrine:mapping:import CasavanaCOBDBundle annotation
echo "Mapa importado: Pulse una tecla para continuar..."
read -s

php ../app/console doctrine:generate:entities CasavanaCOBDBundle
echo "Entidades generadas: Pulse una tecla para continuar..."
read -s
