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

Invoices
====================

```php
require_once ('cryptopay.php');
$invoice_data = array(
	'price'				=> 1000.00,
	'currency'			=> 'GBP',
);

$api = new Cryptopay('api_key');
$invoice = $api->invoice($invoice_data);
```

Payment buttons
====================

```php
require_once ('cryptopay.php');
$button_data = array(
    'price'		=> 1000.00,
    'currency'	=> 'GBP',
    'name'		=> 'test',
);
$button_name = 'Some button name';

$api = new Cryptopay('api_key');
$button = $api->button($button_data, $button_name);
$button2 = $api->button($button_data);
```

Hosted page
====================

```php
require_once ('cryptopay.php');
$hosted_data = array(
	'id'					=> 'Awesome invoice 120',
	'currency'				=> 'GBP',
	'collect_email'			=> true,
	'collect_phone'			=> true,
	'collect_name'			=> true,
	'collect_address'		=> true,
	'success_redirect_url'	=> 'http://example.com/success.html',
	'callback_url'			=> 'http://requestb.in/13lffoc1',
	'form'					=> 'Date of Birth:',
	'items'					=> array(
		array(
			'name'			=> 'Test item 1',
			'description'	=> 'Test item 1 description',
			'quantity'		=> 1,
			'vat_rate'		=> 13,
			'price'			=> 55,
		),
		array(
			'name'			=> 'Test item 2',
			'description'	=> 'Test item 2 description',
			'quantity'		=> 1,
			'vat_rate'		=> 13,
			'price'			=> 66,
		),
	),
);

$api = new Cryptopay('api_key');
$hosted = $api->hosted($hosted_data);
```

Rate
====================

```php
require_once ('cryptopay.php');
$api = new Cryptopay('api_key');
$rate = $api->rate();
```

Invoices List
====================

```php
require_once ('cryptopay.php');
$api = new Cryptopay('api_key');
$rate = $api->invoices();
```

Validate Hash
====================

```php
require_once ('cryptopay.php');
$validate_hash_data = array(
	'uuid'		=> 'f777b0da-54e1-4880-9318-7fde7e6b09e',
	'price'		=> 2.00,
	'currency'	=> 'EUR',
);
$api = new Cryptopay('api_key');
$rate = $api->validate_hash($validate_hash_data);
```