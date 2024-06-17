Just another simple MVC PHP app.

Запуск: `git clone https://github.com/e7paul/simple-php-crud-app.git && cd "$(basename "$_" .git)" && ./init.sh`
\
\
\
\
1.3 DDL для более оптимизированной БД

```
create table main.products
(
id    bigint unsigned auto_increment
primary key,
title varchar(255)   null,
price decimal(10, 2) null
);

create table main.user
(
id          bigint unsigned auto_increment
primary key,
first_name  varchar(255) null,
second_name varchar(255) null,
birthday    date         null,
created_at  datetime     null
);

create table main.user_order
(
id         bigint unsigned auto_increment
primary key,
user_id    bigint unsigned                     not null,
product_id bigint unsigned                     not null,
created_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
constraint user_order_products_id_fk
unique (product_id),
constraint user_order_user_id_fk
unique (user_id),
constraint user_order_products_id_fk
foreign key (product_id) references main.products (id),
constraint user_order_user_id_fk
foreign key (user_id) references main.user (id)
);
```
Кратко: добавляем `id` в `user_order`, меняем все `id` на тип `bigint unsigned`, добавляем внешние ключи для таблицы `user_order`. Также можно заменить id на uuid/ulid.

2 - Полиморфизм.
3 - SQL - это язык запросов. MySQL - это система управления БД.
4 - Реализовано в одноименном трейте.