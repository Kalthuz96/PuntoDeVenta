# PuntoDeVenta
Caso practico para la vacante de programador en BackEnd
Se actualizaron los archivos por subida erronea al main

Para poder montar en un servidor local se requiere crear el archivo .htaccess con el siguiente código:
Options All -Indexes
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)$ index.php?link=$1 [QSA,L]

Para acceder al login los datos son:

Usuario: admin
Contraseña: admin
