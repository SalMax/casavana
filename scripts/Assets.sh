#!/bin/bash
cd ..
php ./app/console assets:install
echo "Pulse una tecla para continuar..."
read -s
