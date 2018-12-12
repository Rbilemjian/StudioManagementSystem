#!/bin/bash
#COMP 586
#Raffi Bilemjian
#script begin

#Get the IP of the server
ipaddr=`curl http://icanhazip.com/`
#Install php & npm
apt-get --yes update
apt --assume-yes install php7.2-mbstring
apt --assume-yes install php7.2-dom
apt --assume-yes install php7.2 zip unzip
apt --assume-yes install npm

#Create database for application, grant root user access
mysql -u root -e "CREATE DATABASE studiomanagementsystem"
mysql -u root -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY ''"
mysql -u root -e "GRANT ALL PRIVILEGES ON studiomanagementsystem.* TO 'root'@'localhost' IDENTIFIED BY ''"

#Clone the project from the github repository
git clone https://github.com/rbilemjian/studiomanagementsystem /var/www/comp586
cd /var/www/comp586

#Install Composer
apt --assume-yes install composer
composer update

#Set up .env File (Environment Variables)
sed "
s/APP_ENV=local/APP_ENV=production/
s|APP_URL=http://localhost|APP_URL=http://$ipaddr|
s|DB_USERNAME=placeholdername|DB_USERNAME=root|
s|DB_PASSWORD=placeholderpassword|DB_PASSWORD=|" <.env.example >.env

#generate application key
php artisan key:generate

#Migrate Database (Generates MySQL Database Tables using Laravel app's model definitions)
php artisan migrate

#Seed Database (Populates with random data using Laravel Faker package)
php artisan db:seed

#PHP command needed for initialization of JWT Authentication package
php artisan jwt:secret

#Installing NPM
npm install

#setup nginx server block
cp /etc/nginx/sites-available/default /etc/nginx/sites-available/$ipaddr
tee /etc/nginx/sites-available/$ipaddr > /dev/null <<EOF
server {
listen 80 default_server;
root /var/www/comp586/public;
index index.php index.html index.htm index.nginx-debian.html;

add_header X-Frame-Options "SAMEORIGIN";
add_header X-XSS-Protection "1; mode=block";
add_header X-Content-Type-Options "nosniff";
server_name $ipaddr;

charset utf-8;
location / {

try_files \$uri /index.php?\$query_string;
}
error_page 404 /index.php;
location ~ \.php$ {
try_files \$uri /index.php?\$query_string;
fastcgi_split_path_info ^(.+\.php)(/.+)$;
fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
fastcgi_index index.php;
# include /etc/nginx/fastcgi_params;
include /etc/nginx/fastcgi.conf;
}

location ~ /\.(?!well-known).* {
deny all;
}
}

EOF
#remove original app from server
cd /etc/nginx/sites-enabled/
rm digitalocean
#link to sites enabled
ln -s /etc/nginx/sites-available/$ipaddr /etc/nginx/sites-enabled/

#change ownership of our web directory
cd /var/www
chown -R www-data:www-data comp586

#restart nginx
service nginx restart
#adding certbot
apt-get --yes install software-properties-common
echo | add-apt-repository ppa:certbot/certbot
apt-get --yes update
apt-get --yes install python-certbot-nginx
echo -ne "raffi.bilemjian.398@my.csun.edu" | certbot --non-interactive --nginx

#Running node package manager in production so Vue will work
cd /var/www/comp586
npm run production
