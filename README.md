# SkyEng test task

## Условие

Разработчика попросили реализовать API-метод получения списка уроков, с возможностью указания категории.
Метод будет использоваться на сайте (ответ в формате xml).
Информация об уроках запрашивается из REST-API стороннего сервиса (закрытого basic-авторизацией).

Данные необходимо было кешировать, ошибки логгировать.
Разработчик с задачей справился, ниже представлен его php код (на сервере установлен php 7.1.3).

## Задание:

Проведите максимально подробный Code Review текущего кода, дайте конкретные рекомендации его улучшения, и реализуйте свой вариант.

## Коментарии

Добавил коментарии в код.
Все ошибки отобржаются с одним и тем же сообщением.
Непонятно почему экшен ничего не возвращает, а выводит через echo.
Нет внешнего кода и не указан фреймворк, для которого написан action, соотвественно неизвестно как он вызывается и должен работать.

## Changelog

### [0.1]
#### Исправления
 - Исправлено форматирование
 - Удалён закоментированный отладочный код
 - Добавлены коментарии к коду
