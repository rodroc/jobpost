
# jobpost

Laravel, Typescript &amp; Docker demo




## Set Up & Run Locally

```bash
  $ docker build .
  $ docker-compose -up -d
```
Open docker/terminal under php.

```bash
  $ cd /var/www/html
  $ php composer.phar install
  $ chmod 777 /var/www/html/database/database.sqlite
```
Rename .env-example to .env and update the MAIL_*** settings w/ your own credentials.

Setup, transpile & run the backend microservice:
```bash
$ cd typescript
$ npm i
$ node_modules/.bin/tsc -w
$ node ./dist/app.js
```
Load http://localhost:8088/jobs in your browser.

To access the sqlite/data, load http://localhost:8088/adminer.php.
The database file is located in ..\database\database.sqlite
