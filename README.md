# PuntoDeVenta
Este es un proyecto para la vacante de Desarrollador En BackEnd
Sigue en proceso de creación para mejorar y me ha ayudado a aprender varios apartados que no había utilizado antes

crear archivo .htaccess con los siguientes campos:

Options All -Indexes
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)$ index.php?link=$1 [QSA,L]
