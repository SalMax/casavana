#!/bin/bash
cd ..
composer selfupdate
composer update
echo "Pulse una tecla para continuar..."
read -s