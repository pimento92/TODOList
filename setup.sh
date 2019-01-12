#Cambiar permisos
chmod -R 777 ../html
#Instalar mysql
sudo apt-get install mysql-server
sudo mysql_secure_installation
#Instalar BD
mysql --host=localhost --user=root --pass=root -e "Models\BD_TODOLIST.sql"
