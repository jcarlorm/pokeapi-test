## Instalar

Rama principal Master

Pasos para correr el proyecto (utilice php 8.1.6 y node v16.15.1)

- composer install para instalar dependecias del proyecto de laravel
- npm i o yarn install para las dependencias de javascript
- npm run build para generar los js
- php artisan migrate, para ejecutar las migraciones de BD

configurar el smtp client con mailtrap

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=usuario mailtrap
MAIL_PASSWORD=clave de mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="podekex@example.com"
MAIL_FROM_NAME="${APP_NAME}"


Actualizar el .env para conexión de base de datos

Pagina de prueba

https://pokeapi.bemuss.com/