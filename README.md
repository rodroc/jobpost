
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
Copy .env-example as .env
Update the MAIL_*** settings w/ your own credentials.

Run backend microservice:
```bash
$ cd typescript
$ node .\dist\app.js
```
Load http://localhost:8088/jobs in your browser.