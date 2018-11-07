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