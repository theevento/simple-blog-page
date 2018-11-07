# Simple blog page

## Build application
Clone repository:
```bash
$ git clone https://github.com/theevento/simple-blog-page
```
Go to repository directory:
```bash
$ cd simple-blog-page
```
Set permission to data directory:

```bash
$ sudo chmod -R 777 data/
```
Build image via docker:
```bash
$ docker-compose up -d --build
```
Download vendor via composer:
```bash
$ docker-compose run www composer install
```
Set development mode:
```bash
$ docker-compose run www composer development-enable 
```
Main page:
```text
http://127.0.0.33/blog
```
Login page:
```text
http://127.0.0.33/login
```
Default data for login:
```text
Username: admin
Password: 123
```
And that's it!
## Unit tests
Run PHPUnit tests via docker container:
```bash
$ docker-compose run www ./vendor/bin/phpunit
```
## Database
You don't need to import database manually because it's was maked when you build your docker image, but if you want change something you can find database file right there:
```text
schema/schema.sql
```