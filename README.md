# jobpost
Laravel, Typescript &amp; Docker demo

$ docker build .
$ docker-compose -up -d
#) Open docker/terminal under php.
$ cd /var/www/html
$ php composer.phar install
$ chmod 777 /var/www/html/database/database.sqlite
#) Copy .env-example as .env
#) Update the MAIL_*** settings w/ your own credentials.
#) Run backend microservice:
$ cd typescript
$ node .\dist\app.js
#) Load the browser in http://localhost:8088/jobs

