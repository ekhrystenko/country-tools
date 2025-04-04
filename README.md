# Eugene\CountryTools Package

Пакет `Eugene\CountryTools` надає сервіси для отримання даних про країни, таких як код країни, назва, прапор, телефонний код та валюта. Пакет використовує репозиторії для зберігання та доступу до даних про країни, а також надає сервіси для кешування результатів задля покращення продуктивності.

Підтримувані версії:
- [Laravel ^11.x](https://laravel.com/docs/11.x)
- PHP ^8.3

Автор
- [Eugene Khrystenko](https://github.com/ekhrystenko) (swallow1991@gmail.com)

## Встановлення

Оскільки пакет ще не опубліковано на Packagist, його потрібно підключити через VCS-репозиторій вручну. Для цього додайте у `composer.json` вашого проєкту:

```json
"repositories": [
    {
    "type": "vcs",
    "url": "https://github.com/ekhrystenko/country-tools"
    }
]
```
## Додайте сам пакет у require
```bash
composer require eugene/country-tools:dev-master
composer update
```

##  (Необов'язково) Додайте minimum-stability, якщо пакет ще не має релізу:

```json
"minimum-stability": "dev",
"prefer-stable": true
```

## Генерація файлу countries.json

Для генерації файлу з даними про країни можна використати команду GenerateCountryJson. Ця команда завантажує дані про країни з API та генерує JSON файл.

```bash
php artisan country:generate-json
```

## Використання змінної середовища для шляху до файлу
Для налаштування шляху до файлу countries.json можна використовувати змінну середовища COUNTRY_JSON_PATH в .env файлі.
Якщо змінна середовища COUNTRY_JSON_PATH не задана, пакет використовуватиме дефолтний шлях, що знаходиться в пакеті.

```json
COUNTRY_JSON_PATH=/path/to/project/storage/countries.json
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

