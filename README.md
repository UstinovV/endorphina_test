Задание реализовано на базе фреймворка Yii 2.0 Basic Application Template и базы данных MySQL
Для запуска проекта используется Docker и утилита docker-compose

Логика задания реализована в SiteController/PlayAction()

База Данных:
Структура:
user_bonuses - таблица содержит id пользователя и его текущий счёт бонусных балов
user_money - таблица содержит id пользователя и его текущий финансовый счёт
items - таблица содержит список призов

Структура базы данных находится в корне проекта в файле create_db.sql