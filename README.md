## Реализация проекта
* реализована регистрация и авторизация - App/Http/Controller/Auth
  * регестрация - App/Http/Controller/Auth/RegisterController.php
  * авторизация - App/Http/Controller/Auth/LoginController.php
* Получение списка хайку - App/Http/Controllers/Haikus/IndexController.php
* Получение одного хайку - App/Http/Controllers/Haikus/ViewController.php
* Создание хайку - App/Http/Controllers/Haikus/CreateController.php
* Редактирование хайку - App/Http/Controllers/Haikus/UpdateController.php
* Удаление хайку - App/Http/Controllers/Haikus/DeleteController.php

## Установка сборки 
1.  Клонирование репозитория:
```sh
git clone https://github.com/Leonid11117/testWandry
```
* Создание файла .env с файла .env.example
2. Выполнение команды на формирование контейнеров для докера, это нужно делать в папке проекта:
```sh
docker-compose build
```
3. Запуск контейнеров:
```sh
docker-compose up -d 
```
4. Заходим в контейнер php:
```sh
docker exec -it php bash
```
5. Устанавливаем все дополнительные файлы в контейнере:
```sh
composer install
```
6. Выполняем команду для генерации ключа в контейнере:
```sh
php artisan key:generate
```
7. Запуск миграций:
```sh
php artisan migrate
```
8. Затем генерируем api документацию:
```sh
php artisan l5-swagger:generate
```
## Api:
1) http://localhost:8002/api/documentation/ - Api документация.
2) http://localhost:8002/api/register/ - регестрация.
3) http://localhost:8002/api/login/ - авторизация
