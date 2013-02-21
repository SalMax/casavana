#!/bin/bash

php ../app/console doctrine:schema:update --force
echo "Pulse una tecla para continuar..."
read -s
