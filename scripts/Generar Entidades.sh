#!/bin/bash

php ../app/console doctrine:mapping:import CasavanaCOBDBundle annotation
echo "Mapa importado: Pulse una tecla para continuar..."
read -s

php ../app/console doctrine:generate:entities CasavanaCOBDBundle
echo "Entidades generadas: Pulse una tecla para continuar..."
read -s
