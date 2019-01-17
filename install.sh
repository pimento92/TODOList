#!/bin/bash
#Cambiar permisos
chmod -R 777 .;
#Instalar mysql
apt-get install -y mysql-server;
#Instalar BD
mysql -uroot -piu < ./Models/BD_TODOList.sql;
exit;
