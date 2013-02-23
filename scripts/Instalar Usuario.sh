#!/bin/bash

php ../app/console fos:user:create admin admin@example.com admin --super-admin 
echo "Entidades generadas: Pulse una tecla para continuar..."
read -s
