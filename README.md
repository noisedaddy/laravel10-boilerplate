## About

App
http://0.0.0.0:8083/

Telescope
http://0.0.0.0:8083/telescope

Mailpit
http://0.0.0.0:8025/

## Docker & sail

start sail:
php artisan sail:install

./vendor/bin/sail up

publish DockerFile:

./vendor/bin/sail artisan sail:publish

Docker commands:
./vendor/bin/sail down

./vendor/bin/sail build --no-cache

./vendor/bin/sail up -d
