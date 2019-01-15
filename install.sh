#!/bin/bash
#Cambiar permisos
chmod -R 777 /var/www/html
#Instalar mysql
sudo apt-get install mysql-server
sudo mysql_secure_installation
#Instalar BD
mysql -u root -p TODOLISTDB < /var/www/html/Models/BD_TODOLIST.sql
