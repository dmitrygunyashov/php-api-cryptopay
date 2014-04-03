PHP API Client for Cryptopay
====================

Описание
====================

Клиент на PHP для работы с cryptopay.me API.
Документация по API: https://cryptopay.me/api

Установка
====================

1. Копируем и подключаем cryptopay.php к себе в проект
2. Заходим на сайте cryptopay.me в Account -> Settings
3. Генерируем и копируем API key

Пример использования
====================

```php
require_once ('cryptopay.php');
$data = array(
	'price'				=> 1000.00,
	'currency'			=> 'GBP',
);

$api = new Cryptopay('api_key');
$result = $api->invoice($data);
```