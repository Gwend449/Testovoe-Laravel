
# Product Catalog API (Laravel)

## Техничнское Задание

Реализовать поиск по товарам с фильтрами
Реализовать HTTP-endpoint (например, GET /api/products), который возвращает список товаров с возможностью фильтрации и сортировки.

У товара должны быть поля:
* id
* name (string, индекс по LIKE или FULLTEXT если захочешь)
* price (decimal)
* category_id (foreign key на таблицу categories)
* in_stock (boolean)
* rating (float, 0–5)
* created_at
* updated_at

Фильтры (через query-параметры):
* q — поиск по подстроке в name
* price_from, price_to
* category_id
* in_stock (true/false)
* rating_from

Сортировка:
параметр sort с допустимыми значениями: price_asc, price_desc, rating_desc, newest.

Обязательна пагинация.

## Технологический стек
> Laravel\
> PHP\
> Postgres\
> Docker\

## Решения в ходе разработки

- **ProductService:** Вся бизнес-логика вынесена из контроллера в отдельный сервис. Валидация с помощью `FormRequest`. Для более безопасной валидации в будущем можно использовать `DTO`. Также в будущем, когда условий для фильтрации станет много можно прибегнуть к паттерну `Pipeline`.
- **ApiResource:** Ответы стандартизированы с помощью ресурсов. Гарантирует что изменения в бд не сломают фронтенд. 
- **Оптимизация БД:** Для поля `name` используется `FULLTEXT INDEX`. Быстрый поиск при больших объемах информации. 
- **Тесты:** Функционал покрыт тестами `Tests\Feature\ProductApiTest`.


## 🛠 Установка и запуск

1. **Клонируйте репозиторий:**
   ```bash
   git clone <url_вашего_репозитория>


2. **Поднимите docker-контейнеры:**
   ```bash
   docker-compose up -d --build


3. **Настройте .env и запустите db:seed:**
   ```bash
   php artisan migrate --seed


### Параметры запроса (Query Parameters)

| Параметр     | Описание                                   | Пример значения         |
|--------------|--------------------------------------------|-------------------------|
| `q`          | Полнотекстовый поиск по названию товара    | `?q=iphone`             |
| `price_from` | Минимальная цена                           | `?price_from=1000`      |
| `price_to`   | Максимальная цена                          | `?price_to=5000`        |
| `category_id`| ID категории                               | `?category_id=2`        |
| `in_stock`   | Наличие (`1`/`0` или `true`/`false`)       | `?in_stock=true`        |
| `rating_from`| Минимальный рейтинг (от `0` до `5`)        | `?rating_from=4.5`      |
| `sort`       | Сортировка (см. ниже)                      | `?sort=price_asc`       |


### Пример запроса

```http
GET /api/products?price_from=400&rating_from=3.0&in_stock=true&sort=rating_desc

