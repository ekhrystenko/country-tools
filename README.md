## Eugene\CountryTool Package

Пакет Eugene\CountryTools надає сервіси для отримання даних про країни, таких як код країни, назва, прапор, телефонний код та валюта. Пакет використовує репозиторії для зберігання та доступу до даних про країни і надає сервіси для кешування результатів для покращення продуктивності.

[Laravel 11.x^](https://laravel.com/docs/11.x)

PHP 8.3^

## Генерація файлу countries.json

Для генерації файлу з даними про країни можна використати команду GenerateCountryJson. Ця команда завантажує дані про країни з API та генерує JSON файл.

```bash
php artisan country:generate-json
```

## Використання змінної середовища для шляху до файлу
Для налаштування шляху до файлу countries.json можна використовувати змінну середовища COUNTRY_JSON_PATH в .env файлі.
Якщо змінна середовища COUNTRY_JSON_PATH не задана, пакет використовуватиме дефолтний шлях, що знаходиться в пакеті.

```bash
COUNTRY_JSON_PATH=/path/to/project/storage/countries.jso
```

## Тестування класу CountryService
Тестування класу CountryService можна здійснити за допомогою PHPUnit, використовуючи команду:

```bash
./vendor/bin/phpunit tests/CountryServiceTest.php
```

## Використання в проєкті
Після встановлення пакету викорисовуємо фасад Country

## Список методів

```bash
Country::getCountryCodes()
Country::getCountry($code)
Country::getName($code)
Country::getFlag($code)
Country::getPhoneCode($code)
Country::getCurrency($code)
```

