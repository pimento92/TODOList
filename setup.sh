#!/bin/bash
#Cambiar permisos
chmod -R 777 ../html
#Instalar mysql
sudo apt-get install mysql-server
sudo mysql_secure_installation
#Instalar BD
mysql --host=localhost --user=todolistdba --password=todolistpass  -e "Models\BD_TODOLIST.sql"