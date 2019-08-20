# TURTRADING

## Introduction

Plataforma para programar estrategias y recibir alertas automaticamente.

## Code Samples

Los usuarios registrados pueden encontrarse en database/seeds/UsersTableSeeder.php

En caso de no poseer un env.example para la instalación:
crear archivo .env y pegar el siguiente contenido 

APP_NAME="TURTRADING"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io

MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

ALPHA_VANTAGE_API_URL=https://www.alphavantage.co

MASTER_KEY=

TELEGRAM_BOT_USERNAME=

TELEGRAM_BOT_TOKEN=

TELEGRAM_BOT_URL=

TELEGRAM_CHANEL=

TELEGRAM_CHANNEL_ID=

## Installation

1) copiar todo el contenido del archivo .env.example y pegarlo dentro del archivo .env 

2) agregar tus credenciales de base de datos en DB_DATABASE=, DB_USERNAME= y DB_PASSWORD  

3) susituir en el .env la linea APP_URL=http://desarrollo.local/  por la url local del proyecto

4) ejecutar composer install

5) ejecutar php artisan migrate --seed

6) Para que funcione el pool se requieren las credenciales de telegram solicitadas en el .env

7) La configutacion basica del sistema puede modificarse en la tabla settings



