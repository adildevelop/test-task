# Тестовое задание

### Постановка задачи

Необходимо разработать небольшой API для создания и открутки рекламных объявлений без использования фреймворков — подключите необходимые библиотеки через Composer. Для хранения объявлений можете использовать любое хранилище.

API состоит из трёх роутов: создания, редактирования и открутки

## Инструкция по развертыванию проекта

В проекте используется: PHP(>=7.4), PostgreSQL, Nginx, Docker

Так как в проекте используется Docker и Docker-Compose, чтобы развернуть проект необходимо локально установленный Docker.

1. Склонировать проект
```
git clone https://github.com/ba1apan/test-task.git
```

2. Перейти в директорию проекта
```
cd /test-task
```

3. Собрать проект через докер
```
docker-compose build
```

4. Запустить проект
```
docker-compose up -d
```

5. Проект доступен по адресу 
```
http://localhost:8080
```

6. Для запуска тестов можно использовать следующую команду
```
docker-compose exec web ./vendor/bin/phpunit
```

## Руководство по использованию

### Создание объявления

Пример запроса

```http request
POST /ads HTTP/1.1
Host: localhost
Content-Type: application/x-www-form-urlencoded
...
text=Advertisement1&price=300&limit=1000&banner=https://linktoimage.png
```

Описание полей

| Поле | Описание  | Тип  |
|---|---|---|
| text | Заголовок объявления | Строковый |
| price | Стоимость одного показа | Числовой |
| limit | Лимит показов | Числовой |
| banner | Ссылка на картинку | Строковый |


Пример ответа

```http request
HTTP/1.1 200 OK
Content-Type: application/json
...
{
  "message": "OK",
  "code": 200,
  "data": {
     "id": 123,
     "text": "Advertisement1",
     "banner": "https://linktoimage.png"   
  }
}
```

Пример ответа с ошибкой валидации поля

```http request
HTTP/1.1 200 OK
Content-Type: application/json
...
{
  "message": "\"banner\" field contains invalid banner link",
  "code": 422,
  "data": null
}
```

### Открутка объявления

Возвращается _id_, _text_ и _banner_ объявления. Выбирается по следующим условиям:

- У него должна быть самая высокая цена.
- Количество открученных показов этого объявления не должно превышать лимит
  показов (поле limit).

Пример запроса

```http request
GET /ads/relevant HTTP/1.1
Host: localhost
...
```

Пример ответа

```http request
HTTP/1.1 200 OK
Content-Type: application/json
...
{
  "message": "OK",
  "code": 200,
  "data": {
     "id": 123,
     "text": "Advertisement1",
     "banner": "https://linktoimage.png"   
  }
}
```

### Редактирование объявление

Пример запроса

```http request
POST /ads/1234 HTTP/1.1
Host: localhost
Content-Type: application/x-www-form-urlencoded
...
text=Advertisement123&price=450&limit=1200&banner=https://linktoimage.png
```

Пример ответа

```http request
HTTP/1.1 200 OK
Content-Type: application/json
...
{
  "message": "OK",
  "code": 200,
  "data": {
    "id": 123,
    "text": "Advertisement123",
    "banner": "https://linktoimage.png"
  }
}
```

Пример ответа если объявление не найдено

```http request
HTTP/1.1 404 Not Found
Content-Type: application/json
...
{
  "message": "Not Found",
  "code": 404,
  "data": null
}
```