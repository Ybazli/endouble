# Endouble Assignment Project

This project serves on [Lumen micro framwork](https://lumen.laravel.com/docs/5.8) 5.8v. for http request i used `GuzzleHttp` packag.

## Instalation and run project

Go to project folder and run this command for installing dependencies with the composer:

```bash
composer update
```

copy .env.example as .env file:

```bash
cp .env.example .env
```

To running the project, run this command in the terminal (you most to have php on your machine) :

```bash
php -S localhost:8000 -t public
```

Now the project can be accessible on http://localhost:8000/api 

or [laravel valet](https://laravel.com/docs/5.8/valet) can be used.

##Modules

For register new module you should create new php class and **implements** from ApiInterface and overwrite the get method. after that in Api/Api.php you should register your new module 'id'  in switch case section.

the exist modules are SpaceX and Xkcd under the app\Api folder.

### SapceX

The Space X module location is Api\SpaceX.php. 

### XKCD



## Request

The `/api` url with Get method is exist for handling our request. for example : http:localhost:8080/api

For testing api, [PostMan](https://www.getpostman.com) or web browsers can be used.

## Parametrs

| Params     | Description                                                  |
| :--------- | :----------------------------------------------------------- |
| `sourceId` | Required - value most one of : space , comics , comic        |
| `limit`    | Not Required - only for space and comics sourceId - value most to be integer |
| `year`     | Not Required - only for space and comics sourceId - value most integer like: '2018' |
| `id`       | Not Required - only for comic sourceId - velue most be a integer |

if the `sourceId` wasn't exists or if it's null, the application automatically returns ApiExseption error with 400 response code.

## Tests

The test files is in /tests folder. SpaceTest,XkcdTest and ApiTest . For running the test, if you have phpunit on your machine run that in the project root. if you haven't, then install as global with composer with this command:

```bash
composer global require phpunit/phpunit
```

Now you can access to `phpunit` alias.

**Notice** : 